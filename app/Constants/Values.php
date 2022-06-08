<?php

namespace App\Constants;

/**
 * Class Values
 * @package App\Constants
 */
class Values extends CustomEnum
{
    const PASSWORD_POLICY = 'string|required|between:6,20|regex:/^(?=.*[a-z])(?=.*\d).{6,20}/';
    const FIREBASE_DYNAMIC_LINK = "https://links.b4bh.com";
    const NO_RESOURCE_KEY = "NO_RESOURCE_KEY";
    const CDN_LINK = "https://b4bh.s3.me-south-1.amazonaws.com/";
    const ITEMS_PER_PAGE = 10;
    const SEARCH_ITEMS_PER_PAGE = 5;
    const CARBON_TIME_FORMAT = "h:iA";
    const CARBON_DATE_FORMAT = "d M Y";
    const CARBON_DATE_FORMAT_2 = "dd-mm-yyyy";
    const CARBON_DATE_FORMAT_3 = 'DD/MM/YYYY';
    const CARBON_DATE_FORMAT_4 = "Y-m-d";
    const CARBON_DATE_FORMAT_5 = "Y-m-d H:i:s";
    const CARBON_DATE_FORMAT_7 = "M d";
    const CARBON_TIME_FORMAT_8 = "H:i";
    const CARBON_DATE_FORMAT_9 = "d-m-Y";
    const CARBON_DATE_FORMAT_10 = "Y-m-d";
    const CARBON_DATE_FORMAT_11 = "c";
    const CARBON_DAY_FORMAT = "l";
    const DEFAULT_TIMEZONE = "Asia/Bahrain";

    // FCM
    const FCM_PRIORITY_ANDROID = "normal";
    const FCM_PRIORITY_IOS = "5";
    const FCM_PROJECT_ID = "b4bh-app-dee0a";
    const FCM_COLOR = "#E12027";

    // Activity Booking
    const LOCK_BOOKING = 15;

    const CARBON_FORMAT_2 = "";
}
