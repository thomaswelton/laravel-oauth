<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Routing array
    |--------------------------------------------------------------------------
    |
    | Already using the oauth route in your app?
    | No worries! Set a different one here
    |
    */

    'route' => 'oauth',

    /*
    |--------------------------------------------------------------------------
    | Default redirect
    |--------------------------------------------------------------------------
    |
    | After successful login where should we redirect the user?
    | Uncomment the below line to set a default redirect
    |
    | You can also add a 'redirect' key to any of the provider
    | arrays below, to set provider specific redirects after login
    |
    */

    //'redirect' => '',

    /*
    |--------------------------------------------------------------------------
    | Amazon
    |--------------------------------------------------------------------------
    |
    | Create a new app - http://login.amazon.com/manageApps
    |
    | Requires HTTPS support.
    |
    | Key - Amazon calls this the App ID
    | Secret - Amazon calls this the Client Secret
    | Scope - Comma seperated string
    |
    */
    'amazon' => array(
        'key' => '',
        'secret' => '',
        'scope' => ''
    ),

    /*
    |--------------------------------------------------------------------------
    | Dropbox
    |--------------------------------------------------------------------------
    |
    | Create a new app - https://www.dropbox.com/developers/apps/create
    |
    | Requires HTTPS support.
    |
    | Key - Dropbox calls this the App key
    | Secret - Dropbox calls this the App Secret
    | Scope - Comma seperated string
    |
    */
    'dropbox' => array(
        'key' => '',
        'secret' => '',
        'scope' => ''
    ),

    /*
    |--------------------------------------------------------------------------
    | Bitbucket
    |--------------------------------------------------------------------------
    |
    | Create a new app, "account" -> "integrated applications" ->  "Add consumer"
    | https://bitbucket.org/account/user/YOUR_USERNAME/api
    |
    | Requires HTTPS support.
    |
    | Key - Bitbucket calls this the App key
    | Secret - Bitbucket calls this the App Secret
    | Scope - Comma seperated string
    |
    */
    'bitbucket' => array(
        'key' => '',
        'secret' => '',
        'scope' => ''
    ),

    /*
    |--------------------------------------------------------------------------
    | Paypal
    |--------------------------------------------------------------------------
    |
    | Create a new app - https://developer.paypal.com/webapps/developer/applications/myapps
    |
    | Enable "login with paypal" and request both Basic auth and personal information
    |
    | Key - Paypal calls this the Client ID
    | Secret - Paypal calls this the Secret
    | Scope - Comma seperated string
    |
    */
    'paypal' => array(
        'key' => '',
        'secret' => '',
        'scope' => 'profile, openid'
    ),

    /*
    |--------------------------------------------------------------------------
    | Facebook
    |--------------------------------------------------------------------------
    |
    | Create a new app - https://developers.facebook.com/apps
    |
    | Key - Facebook calls this the App ID
    | Secret - Facebook calls this the App Secret
    | Scope - Comma seperated string - See https://developers.facebook.com/docs/reference/login/
    |
    */
    'facebook' => array(
        'key' => '',
        'secret' => '',
        'scope' => ''
    ),

    /*
    |--------------------------------------------------------------------------
    | Twitter
    |--------------------------------------------------------------------------
    |
    | Create a new app - https://dev.twitter.com/apps/new
    |
    | Key - Twitter calls this the Consumer key
    | Secret - Twitter calls this the App Secret
    | Scope - Comma seperated string - See https://developers.facebook.com/docs/reference/login/
    |
    */
    'twitter' => array(
        'key' => '',
        'secret' => '',
        'scope' => ''
    ),

    /*
    |--------------------------------------------------------------------------
    | Google
    |--------------------------------------------------------------------------
    |
    | Create a new app - https://developers.google.com/+/quickstart/php
    | When creating the app set the redirect URI to be yousite.com/oauth/google/
    |
    | Key - Google calls this the Client ID
    | Secret - Google calls this the Client Secret
    | Scope - Comma seperated string - See https://developers.google.com/accounts/docs/OAuth2Login
    |
    */
    'google' => array(
        'key' => '',
        'secret' => '',
        'scope' => 'openid email'
    ),

    /*
    |--------------------------------------------------------------------------
    | GitHub
    |--------------------------------------------------------------------------
    |
    | Create a new app - https://github.com/settings/applications/new
    | When creating the app set the redirect URI to be yousite.com/oauth/github/
    |
    | Key - GitHub calls this the Client ID
    | Secret - GitHub calls this the Client Secret
    | Scope - Comma seperated string - See http://developer.github.com/v3/oauth/#scopes
    |
    */
    'github' => array(
        'key' => '',
        'secret' => '',
        'scope' => ''
    ),

    /*
    |--------------------------------------------------------------------------
    | Instagram
    |--------------------------------------------------------------------------
    |
    | Create a new app - http://instagram.com/developer/clients/register/
    |
    | Key - Instagram calls this the Client ID
    | Secret - Instagram calls this the Client Secret
    } Scope - Comma seperated string - See http://instagram.com/developer/authentication/
    |
    */
    'instagram' => array(
        'key' => '',
        'secret' => '',
        'scope' => 'basic'
    ),

    /*
    |--------------------------------------------------------------------------
    | Microsoft
    |--------------------------------------------------------------------------
    |
    | Create a new app - https://account.live.com/developers/applications/create
    |
    | Key - Microsoft calls this the Client ID
    | Secret - Microsoft calls this the Client Secret
    | Scope - Comma seperated string - See http://msdn.microsoft.com/en-us/library/live/hh243646.aspx
    |
    */
    'microsoft' => array(
        'key' => '',
        'secret' => '',
        'scope' => 'wl.basic'
    ),

    /*
    |--------------------------------------------------------------------------
    | LinkedIn
    |--------------------------------------------------------------------------
    |
    | Create a new app - https://www.linkedin.com/secure/developer
    |
    | Key - LinkedIn calls this the API Key
    | Secret - LinkedIn calls this the Secret Key
    | Scope - Comma seperated string - See https://developer.linkedin.com/documents/authentication#granting
    |
    */
    'linkedin' => array(
        'key' => '',
        'secret' => '',
        'scope' => ''
    ),

    /*
    |--------------------------------------------------------------------------
    | Foursquare
    |--------------------------------------------------------------------------
    |
    | Create a new app - https://foursquare.com/developers/apps
    |
    | Key - Foursquare calls this the Client ID
    | Secret - Foursquare calls this the Client Secret
    | Scope - No scope
    |
    */
    'foursquare' => array(
        'key' => '',
        'secret' => '',
        'scope' => ''
    ),

    /*
    |--------------------------------------------------------------------------
    | FitBit
    |--------------------------------------------------------------------------
    |
    | Create a new app - https://dev.fitbit.com/apps/new
    |
    | Key - FitBit calls this the Consumer key
    | Secret - FitBit calls this the Consumer Secret
    | Scope - No scope
    |
    */
    'fitbit' => array(
        'key' => '',
        'secret' => '',
        'scope' => ''
    ),

    /*
    |--------------------------------------------------------------------------
    | Bitly
    |--------------------------------------------------------------------------
    |
    | Create a new app - https://bitly.com/a/create_oauth_app
    |
    | Key - BitLy calls this the Client ID
    | Secret - BitLy calls this the Client Secret
    | Scope - No scope
    |
    */
    'bitly' => array(
        'key' => '',
        'secret' => '',
        'scope' => ''
    ),

    /*
    |--------------------------------------------------------------------------
    | Soundcloud
    |--------------------------------------------------------------------------
    |
    | Create a new app - http://soundcloud.com/you/apps/new
    |
    | Key - Soundcloud calls this the Client ID
    | Secret - Soundcloud calls this the Client Secret
    | Scope - No scope
    |
    */
    'soundcloud' => array(
        'key' => '',
        'secret' => '',
        'scope' => ''
    ),

    /*
    |--------------------------------------------------------------------------
    | Box
    |--------------------------------------------------------------------------
    |
    | Create a new app - https://app.box.com/developers/services/edit/
    |
    | Key - Box calls this the Client ID
    | Secret - Box calls this the Client Secret
    | Scope - No scope
    |
    */
    'box' => array(
        'key' => '',
        'secret' => '',
        'scope' => ''
    ),

    /*
    |--------------------------------------------------------------------------
    | tumblr
    |--------------------------------------------------------------------------
    |
    | Create a new app - http://www.tumblr.com/oauth/register
    |
    | Key - tumblr calls this the OAuth Consumer Key
    | Secret - tumblr calls this the Secret Key
    | Scope - No scope
    |
    */
    'tumblr' => array(
        'key' => '',
        'secret' => '',
        'scope' => ''
    ),

);
