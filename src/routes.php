<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    //$this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.php', $args);
});

$app->post('/', function ($request, $response, $args) {
    $error   = false;
    $result  = '';
    // set the "required fields" to check
    $required_fields = array(
        "contactname",
        "email",
        "phone",
        "message"
    );

    // this part fetches everything that has been POSTed, sanitizes them and lets us use them as $form_data['subject']
    foreach ($_POST as $field => $value) {
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        $form_data[$field] = strip_tags($value);
    }

    // if the required fields are empty, switch $error to TRUE
    foreach ($required_fields as $required_field) {
        $value = !empty($form_data[$required_field])?trim($form_data[$required_field]):'';
        if (empty($value)) {
            $error = true;
            $has_error[$required_field] = true;
        }
    }

    // Check Email
    $form_data['email'] = filter_var($form_data['email'], FILTER_SANITIZE_EMAIL);

    // Validate e-mail
    if (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $has_error['email'] = true;
    }

    /* Verify Captcha */
    $captcha_response = verifyCaptcha($_POST['g-recaptcha-response']);
    if (!$captcha_response->success) {
        $error = true;
        $has_error['recaptcha'] = true;
    }

    if ($error == false) {
        // Mailgun Credentials Instantiate the client.
        $mgClient = new Mailgun\Mailgun(getenv('MAILGUN_KEY'));
        $domain = 'mailgun.vicksburgfamilydentistry.com';
        // Add DB Logging Here


        /* Email Admin */

        $htmlEmail = file_get_contents(__DIR__ . '/../public/html/email.html');

        /* Replace Logo */
        $logo = getenv('APP_URL').'/img/vicksburg-family-dentistry-logo-email.jpg';
        $htmlEmail = str_replace('../img/vicksburg-family-dentistry-logo-email.jpg', $logo, $htmlEmail);

        $formDataEmail = '<br><table style="color: #636466; font-family: \'Helvetica\' \'Arial\', sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 14px;">
                <tr>
                    <td valign="top" width="180">Name: </td>
                    <td>' . $form_data['contactname'] . '</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>' . $form_data['email'] . '</td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td>' . $form_data['phone'] . '</td>
                </tr>
                <tr>
                    <td colspan="2">Message:</td>
                </tr>
                <tr>
                    <td colspan="2">' . $form_data['message'] . '</td>
                </tr>
            </table>';

        $htmlEmail = str_replace('!*data*!', $formDataEmail, $htmlEmail);
        // Send the Email
        $message = $mgClient->sendMessage($domain, array(
            'from'    => 'Vicksburg Family Dentistry Website <postmaster@mailgun.vicksburgfamilydentistry.org>',
            'to'      => 'Matt Crandell <matt@crandelldesign.com>', // Use comma for 2nd email
            'subject' => 'You\'ve Been Contacted By the Vicksburg Family Dentistry Website',
            'text'    => 'Your mail does not support HTML',
            'html'    => $htmlEmail
        ));
        $result = "Thanks for your e-mail! We'll get back to you as soon as we can.";
        // ...and switch the $sent variable to TRUE
        $sent   = true;
        // Unset form data variable
        unset($form_data);
        unset($has_error);
    }
    if (isset($form_data))
        $args['form_data'] = $form_data;
    if (isset($has_error))
        $args['has_error'] = $has_error;
    $args['error'] = $error;
    $args['result'] = $result;
    return $this->renderer->render($response, 'index.php', $args);
});

$app->get('/style-guide', function ($request, $response, $args) {
    // Render Style Guide view
    return $this->renderer->render($response, 'style-guide.php', $args);
});
