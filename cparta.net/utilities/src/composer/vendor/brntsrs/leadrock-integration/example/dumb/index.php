<?php
$API = [
    'key' => 1,
    'secret' => 'asoeubasoiduw3ycopauwg'
];

function send_the_order($post, $API) {
    $params = [
        'flow_url' => $post['flow_url'],
        'user_phone' => $post['phone'],
        'user_name' => $post['name'],
        'other' => $post['other'],
        'ip' => $_SERVER['REMOTE_ADDR'],
        'ua' => $_SERVER['HTTP_USER_AGENT'],
        'api_key' => $API['key'],
        'sub1' => $post['sub1'],
        'sub2' => $post['sub2'],
        'sub3' => $post['sub3'],
        'sub4' => $post['sub4'],
        'sub5' => $post['sub5'],
    ];
    $url = 'https://leadrock.com/api/v2/lead/save';

    $trackUrl = $params['flow_url'] . (strpos($params['flow_url'], '?') === false ? '?' : '') . '&ajax=1';
    foreach ($params as $param => $value) {
        if (strpos($param, 'sub') === 0) {
            $trackUrl .= '&' . $param . '=' . $value;
            unset($params[$param]);
        }
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $trackUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    $params['track_id'] = curl_exec($ch);

    $params['sign'] = sha1(http_build_query($params) . $API['secret']);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_exec($ch);
    curl_close($ch);

    header('Location: ' . $post['success_page']);
}

if (!empty($_POST['phone'])) {
    send_the_order($_POST, $API);
}
?>
<!-- Form example -->
<form class="form" method="post" action="">
    <input type="text" placeholder="Your name" name="name" required>
    <input type="text" placeholder="Your contact phone" name="phone" required>
    <input type="email" placeholder="Shipping address" name="other[address]">
    <input type="text" placeholder="Size" name="other[size]">
    <button type="submit">Submit</button>

    <input type="hidden" name="sub1" value="{sub1)" />
    <input type="hidden" name="sub2" value="{sub2)" />
    <input type="hidden" name="sub3" value="{sub3)" />
    <input type="hidden" name="sub4" value="{sub4)" />
    <input type="hidden" name="sub5" value="{sub5)" />
    <input type="hidden" name="flow_url" value="https://leadrock.com/URL-XXX11-YYY22" />
    <input type="hidden" name="success_page" value="{success_page)" />
</form>
