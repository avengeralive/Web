<?php

// Подключаем файл конфигурации
include_once '../../../includes/config.php';

if (isset($_POST['country'])) {
    $iso_country = preg_replace("/[^a-z]/i", '', $_POST['country']);
}
if (isset($_POST['region'])) {
    $id_region = intval($_POST['region']);
}
if (!isset($_POST['action']))
    exit;
switch ($_POST['action']) {
    case "showRegionForInsert":
        $content = '<select name="region[]" class="regions width-200" ><option value="0">Не указано</option>';
        $sql_region = "SELECT * FROM sxgeo_regions WHERE `country`='$iso_country' ORDER BY `name_ru` ASC";
        $result_region = $mysqli->query($sql_region);
        if (mysqli_num_rows($result_region) > 0) {
            while ($res_region = mysqli_fetch_array($result_region)) {
                $content .= '<option value="' . $res_region['id'] . '">' . $res_region['name_ru'] . '</option>';
            }
        } else {
            $content .= '<option value="0">Без ограничений</option>';
        }
        $content .= '</select>';

        $sql = "SELECT currency FROM sxgeo_country WHERE `iso` = '$iso_country' LIMIT 1";
        $result = $mysqli->query($sql);
        $res = mysqli_fetch_array($result);

        $array = array(
            "content" => $content,
            "currency" => $res['currency']
        );
        echo json_encode($array);
        exit;

        break;
    case "showExRegionForInsert":
        $content = '<select name="excluded_region[]" class="regions width-200" ><option value="0">Не указано</option>';
        $sql_region = "SELECT * FROM sxgeo_regions WHERE `country`='$iso_country' ORDER BY `name_ru` ASC";
        $result_region = $mysqli->query($sql_region);
        if (mysqli_num_rows($result_region) > 0) {
            while ($res_region = mysqli_fetch_array($result_region)) {
                $content .= '<option value="' . $res_region['id'] . '">' . $res_region['name_ru'] . '</option>';
            }
        } else {
            $content .= '<option value="0">Без ограничений</option>';
        }
        $content .= '</select>';

        $sql = "SELECT currency FROM sxgeo_country WHERE `iso` = '$iso_country' LIMIT 1";
        $result = $mysqli->query($sql);
        $res = mysqli_fetch_array($result);

        $array = array(
            "content" => $content,
            "currency" => $res['currency']
        );
        echo json_encode($array);
        exit;

        break;

    case "showCityForInsert":
        echo '<select name="city[]" class="citys" class="width-200"><option value="0">Не указано</option>';
        $sql_cities = "SELECT * FROM sxgeo_cities WHERE `region_id`='$id_region' ORDER BY `name_ru` ASC";
        $result_cities = $mysqli->query($sql_cities);
        if (mysqli_num_rows($result_cities) > 0) {
            while ($res_cities = mysqli_fetch_array($result_cities)) {
                echo '<option value="' . $res_cities['id'] . '">' . $res_cities['name_ru'] . '</option>';
            }
        } else {
            echo '<option value="0">Без ограничений</option>';
        }
        echo '</select>';
        break;

    case "showCountry":
        echo '<select name="country[]" onchange="setRegion(this);" class="width-200">';
        echo '<option value="0">Без ограничений</option>';

        $sql = "SELECT * FROM sxgeo_country ORDER BY `name_ru` ASC";
        $result = $mysqli->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while ($res = mysqli_fetch_array($result)) {
                $current_country_iso = htmlentities($res['iso']);
                $current_country_name = htmlentities($res['name_ru']);
                echo '<option value="' . $current_country_iso . '">' . $current_country_name . '</option>';
            }
        } else {
            echo '<option value="0">Без ограничений</option>';
        }
        echo '</select>';
        break;
    case "showExCountry":
        echo '<select name="excluded_country[]" onchange="setExRegion(this);" class="width-200">';
        echo '<option value="0">Без ограничений</option>';

        $sql = "SELECT * FROM sxgeo_country ORDER BY `name_ru` ASC";
        $result = $mysqli->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while ($res = mysqli_fetch_array($result)) {
                $current_country_iso = htmlentities($res['iso']);
                $current_country_name = htmlentities($res['name_ru']);
                echo '<option value="' . $current_country_iso . '">' . $current_country_name . '</option>';
            }
        } else {
            echo '<option value="0">Без ограничений</option>';
        }
        echo '</select>';
        break;
    case "showCountryWeb":
        echo '<select name="countries[]" style="max-width: 200px;"';
        echo '<option value="0">Без ограничений</option>';

        $sql = "SELECT * FROM sxgeo_country ORDER BY `name_ru` ASC";
        $result = $mysqli->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while ($res = mysqli_fetch_array($result)) {
                $current_country_iso = htmlentities($res['iso']);
                $current_country_name = htmlentities($res['name_ru']);
                echo '<option class="selectCountry _' . strtolower($current_country_iso) . '" value="' . $current_country_iso . '">' . $current_country_name . '</option>';
            }
        } else {
            echo '<option value="0">Без ограничений</option>';
        }
        echo '</select>';
        break;
};
?>