@if ($user)
    <div class="pull-right">
        <br/><br/>

        @if (!empty($user["user_phone"]))
            <img src="/images/phone_icon.png" alt="phone icon"/>
            {{ $user["user_phone"] }}
            <br/>
        @endif

        @if (!empty($user["address"]))
            {{ $user["address"] }}
        @endif

    </div>
    <h1>
        @if (!empty($user["user_logo"]))
            {!! show_pic($user["user_logo"], "medium") !!}
        @endif

        {{ $user['agency'] }}
    </h1>
    <hr/>
    <br/>

@endif