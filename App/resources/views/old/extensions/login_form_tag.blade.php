<script src="/js/login.js"></script>
<div id="main-login-form">
    <a href="javascript:HideLogin()"><img class="close-login-icon" alt="close" src="images/closeicon.png"/></a>
    <h3 class="lfloat" style="margin: 0">
        @php
            if(isset($_REQUEST["error"])&&$_REQUEST["error"]=="login")
            {
                echo $LOGIN_ERROR_MESSAGE;
            }
            else
            if(isset($_REQUEST["error"])&&$_REQUEST["error"]=="no")
            {
                echo $LOGIN_EMPTY_FIELD_MESSAGE;
            }
            else
            if(isset($_REQUEST["error"])&&$_REQUEST["error"]=="expired")
            {
                echo $LOGIN_EXPIRED_MESSAGE;
            }
            else
            {
              echo "Login";
            }
        @endphp
    </h3>

    <hr class="clear"/>
    @php

        $logged_user_type="";

        $AUTH = false;

        if((isset($_COOKIE["AuthU"]))&&$_COOKIE["AuthU"]!="")
        {

            $logged_user_type="agent";
            $ProceedApply = true;
            $arrLoginItems = explode("~", $_COOKIE["AuthU"]);

            $username = $arrLoginItems[0];
            $password = $arrLoginItems[1];
            if($arrLoginItems[2]>time())
            {
                $AUTH = true;
            }

        }

    @endphp

    @if($AUTH)
        <form action="/USERS/logout.php" method="post" class="no-margin">
            <input type="hidden" name="proceed" value="d"/>
            <input type="button" class="btn btn-primary pull-left" value="My Profile"
                   onclick="document.location.href='/USERS/index.php'">
            <input type="submit" class="btn btn-primary pull-left margin-left-20" value=" Logout "/>
        </form>


    @else

        <script>
            function ValidateLoginForm(x) {
                if (x.Email.value == "") {
                    alert("Please enter your username!");
                    x.Email.focus();
                    return false;
                }
                else if (x.Password.value == "") {
                    alert("Please enter your password!");
                    x.Password.focus();
                    return false;
                }
                return true;
            }
        </script>
        @php

            if(isset($_REQUEST["return_url"])&&$_REQUEST["return_url"]!="")
            {

            }
            else
            {
                $return_url="";
                if(isset($_REQUEST["return_category"])) $return_url.="&category=".$_REQUEST["return_category"];
                if(isset($_REQUEST["return_action"])) $return_url.="&action=".$_REQUEST["return_action"];

            }



        @endphp

        <form class="no-margin" action="USERS/loginaction.php" method="post" onsubmit="return ValidateLoginForm(this)">

            <table class="bcollapse">
                @php
                    if(isset($_REQUEST["return_url"]))
                    {
                @endphp
                <input type="hidden" name="return_url" value="@php echo $_REQUEST["return_url"];@endphp">
                @php
                    }
                @endphp

                <tr>

                    <td class="col-sm-2">Username:</td>
                    <td class="col-sm-8 text-left"><input type="text" class="form-field" name="Email"/></td>

                </tr>
                <tr>
                    <td class="col-sm-2">Password:</td>
                    <td class="col-sm-8 text-left"><input class="form-field" type="password" name="Password"/></td>

                </tr>
                <tr>
                    <td colspan="2">

                        <a class="lfloat margin-20" href="index.php?mod=forgotten_password">forgotten password?</a>
                        <br/>
                        <br/>

                        <input type="submit" class="btn btn-primary rfloat margin-20"
                               style="padding-top:0; height:35px;" value="Login"/></td>
                </tr>

            </table>
        </form>
    @endif
    <br/>

    <br/>
</div>
@php
    if(isset($_REQUEST["show_login"]))
    {
        echo "
            <script>document.getElementById('main-login-form').style.display='block';</script>
        ";
    }

    if(isset($_REQUEST["error"]))
    {

        echo "
            <script>document.getElementById('main-login-form').style.display='block';</script>
        ";
    }
@endphp