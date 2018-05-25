<?php
namespace App\Controllers;


use App\Facades\DB;
use App\Listings;
use Domain\HttpRequest;
use Mandrill;
use Mandrill_Error;

class ContactSellerController extends BaseController
{
    public function create($listingId)
    {
        $request = new HttpRequest($_REQUEST);

        $validated_data = [
            'description' => "required",
            'email' => 'email|required',
            'name' => 'required'
        ];

        $listing = $listing = Listings::where('id', $listingId)->first();
        $email_subject = "Inquiry about " . htmlentities($listing['headline']);

        $email_text = $request->description;
        $email_text .= "\n\n Name: " . $request->name .
            "\n Email: " . $request->email;
        if (isset($request->phone)) {
            $email_text .= "\n Phone #: " . $request->phone;
        }

        $email_text .= "\n Vehicle: " . env('APP_URL') . '/details/' . $listing->id;
        $email_text .= "\n\n Referral from Shop4Autos.com";

        $save_email_query = "INSERT INTO " . env('DB_PREFIX') . "ext_messages (date, user_to, subject, message)"
            . "VALUES ('" . time() . "','{$listing['username']}','" . htmlentities(strip_tags($email_subject)) . "','" . htmlentities(strip_tags($email_text)) . "')";

        DB::query($save_email_query);

        $cc_emails = '';
        $email_recipients = array(
            array(
                'email' => "jdunham@pennysaveronline.com",
                'type' => 'to'
            )
        );

        if (env('APP_ENV') != "local") {
            $email_recipients = array(
                array(
                    'email' => $listing->seller()->user_email,
                    'type' => 'to'
                )
            );


            function MandrillCcEmailFormat($email)
            {
                return array("email" => $email, "type" => 'cc');
            }

            if (!empty($listing->seller()->other_emails)) {
                $cc_emails = array_map("MandrillCcEmailFormat", explode(',', $listing->seller()->other_emails));
                array_unshift($cc_emails, $email_recipients[0]);
                $email_recipients = $cc_emails;
            }
        }



        try {
            $mandrill = new Mandrill(env('MANDRILL_SECRET'));
            $message = array(
                'to' => $email_recipients,
                'subject' => $email_subject,
                'text' => $email_text,
                'from_email' => 'no-reply@pennysaveronline.com',
                'from_name' => 'Shop4Autos Customer Inquiry',
                'bcc_address' => 'support@shop4autos.com'
            );

            $result = $mandrill->messages->send($message);

        } catch (Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }

        redirect('details/' . $listing->id . '?email_sent=1');
        
    }

}