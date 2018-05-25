<div id="contact-advertiser" <?php  if (!isset($_REQUEST["contact"])) echo 'class="collapse contact-collapse text-left"';?>>

    <br/>

    <h3>
        <?php
        if(!isset($process_error) || $process_error == "")
        {
        ?>
        <?php echo "Contact";?>

        <?php
        if (isset($listing->seller()->agency)) {
            echo strip_tags(stripslashes($listing->seller()->agency));
        } else {
            echo strip_tags(stripslashes($listing->seller()->user_first_name . " " . $listing->seller()["user_last_name"]));
        }
        ?>
        <?php
        if($listing["phone"] != "")
        {
        ?>
        , <img src="/images/phone_icon.png" alt="phone icon"/> <?php echo strip_tags($listing["phone"]);?>
        <?php
        }
        ?>
        <?php echo "about listing";?> '<?php echo stripslashes(strip_tags($listing['headline']));?>'
        <?php
        }
        else {
            echo $process_error;
        }
        ?>
    </h3>

    <form id="main" action="/details/{{ $listing->id }}/contact" method="post">

        <input type="hidden" name="id" value="<?php echo $id;?>"/>

        <fieldset>
            <legend>Please enter your message or questions below</legend>
            <ol>
                <li>
                    <label for="description">Message Text(*)
                        <br>

                    </label>
                    <textarea id="description" name="description"
                              rows="8">{{ old('description') }}</textarea>
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Contact Information</legend>
            <ol>

                <li>
                    <label for="name">Name(*)</label>
                    <input id="name" name="name" value="{{ old('name') }}"
                           placeholder="Your first and last name" type="text" required/>
                </li>
                <li>
                    <label for="email">Email(*)</label>
                    <input id="email" name="email" value="{{ old('email') }}"
                           placeholder="example@domain.com" type="email" required/>

                </li>
                <li>
                    <label for="phone">Phone</label>
                    <input id="phone" name="phone" value="{{ old('phone') }}"
                           placeholder="" type="text"/>
                </li>

                <li>
                    <label for="code">
                        <img src="/include/sec_image.php" width="100" height="30"/>
                    </label>
                    <input id="code" name="code" placeholder="Please enter the code" type="text" required/>
                </li>

            </ol>
        </fieldset>
        <fieldset>
            <button type="submit">Send</button>
        </fieldset>
    </form>

    <br/><br/>
</div>