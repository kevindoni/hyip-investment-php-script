<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

Route::get('/clear', function () {

    \Illuminate\Support\Facades\DB::statement("INSERT INTO `gateways` (`id`, `name`, `code`, `currency`, `symbol`, `parameters`, `extra_parameters`, `convention_rate`, `currencies`, `min_amount`, `max_amount`, `percentage_charge`, `fixed_charge`, `status`, `note`, `image`, `sort_by`, `created_at`, `updated_at`) VALUES
(33, 'Binance', 'binance', 'USDT', 'USDT', '{\"mercent_api_key\":\"li4shwwt5ugfbboiq1q75dstbmwrgoaetylc7cmulmahh6qxs3clmbytrb7gk2ky\",\"mercent_secret\":\"5elpmjmwvjjsee7kwqqwzcabhtznl0ja8o3pvfsavqrobclsjxamq5kf93uhwcqm\"}', NULL, '1.00000000', '{\"1\":{\"ADA\":\"ADA\",\"ATOM\":\"ATOM\",\"AVA\":\"AVA\",\"BCH\":\"BCH\",\"BNB\":\"BNB\",\"BTC\":\"BTC\",\"BUSD\":\"BUSD\",\"CTSI\":\"CTSI\",\"DASH\":\"DASH\",\"DOGE\":\"DOGE\",\"DOT\":\"DOT\",\"EGLD\":\"EGLD\",\"EOS\":\"EOS\",\"ETC\":\"ETC\",\"ETH\":\"ETH\",\"FIL\":\"FIL\",\"FRONT\":\"FRONT\",\"FTM\":\"FTM\",\"GRS\":\"GRS\",\"HBAR\":\"HBAR\",\"IOTX\":\"IOTX\",\"LINK\":\"LINK\",\"LTC\":\"LTC\",\"MANA\":\"MANA\",\"MATIC\":\"MATIC\",\"NEO\":\"NEO\",\"OM\":\"OM\",\"ONE\":\"ONE\",\"PAX\":\"PAX\",\"QTUM\":\"QTUM\",\"STRAX\":\"STRAX\",\"SXP\":\"SXP\",\"TRX\":\"TRX\",\"TUSD\":\"TUSD\",\"UNI\":\"UNI\",\"USDC\":\"USDC\",\"USDT\":\"USDT\",\"WRX\":\"WRX\",\"XLM\":\"XLM\",\"XMR\":\"XMR\",\"XRP\":\"XRP\",\"XTZ\":\"XTZ\",\"XVS\":\"XVS\",\"ZEC\":\"ZEC\",\"ZIL\":\"ZIL\"}}', '1.00000000', '1000.00000000', '0.0000', '0.00000000', 1, '', '64a9057f0bec51688798591.png', 5, '2023-04-03 01:36:14', '2023-07-08 00:43:11');");

    \Illuminate\Support\Facades\DB::statement("INSERT INTO `payout_methods` (`id`, `name`, `code`, `description`, `bank_name`, `banks`, `parameters`, `extra_parameters`, `image`, `minimum_amount`, `maximum_amount`, `fixed_charge`, `percent_charge`, `status`, `input_form`, `currency_lists`, `supported_currency`, `convert_rate`, `is_automatic`, `is_sandbox`, `environment`, `duration`, `created_at`, `updated_at`) VALUES
(1000, 'Flutterwave', 'flutterwave', 'Payment will receive within 1 days', '{\"0\":{\"NGN BANK\":\"NGN BANK\",\"NGN DOM\":\"NGN DOM\",\"GHS BANK\":\"GHS BANK\",\"KES BANK\":\"KES BANK\",\"ZAR BANK\":\"ZAR BANK\",\"INTL EUR & GBP\":\"INTL EUR & GBP\",\"INTL USD\":\"INTL USD\",\"INTL OTHERS\":\"INTL OTHERS\",\"FRANCOPGONE\":\"FRANCOPGONE\",\"XAF/XOF MOMO\":\"XAF/XOF MOMO\",\"mPesa\":\"mPesa\",\"Rwanda Momo\":\"Rwanda Momo\",\"Uganda Momo\":\"Uganda Momo\",\"Zambia Momo\":\"Zambia Momo\",\"Barter\":\"Barter\",\"FLW\":\"FLW\"}}', '[\"NGN BANK\",\"NGN DOM\",\"GHS BANK\",\"INTL USD\"]', '{\"Public_Key\":\"FLWPUBK_TEST-5003321b93b251536fd2e7e05232004f-X\",\"Secret_Key\":\"FLWSECK_TEST-d604361e2d4962f4bb2a400c5afefab1-X\",\"Encryption_Key\":\"FLWSECK_TEST817a365e142b\"}', NULL, '64a911fa47d4f1688801786.jpg', '10.00', '200000.00', '10.00', '1.00', 1, '[]', '{\"USD\":\"USD\",\"KES\":\"KES\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"UGX\":\"UGX\",\"TZS\":\"TZS\"}', '{\"USD\":\"USD\",\"KES\":\"KES\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"TZS\":\"TZS\"}', '{\"USD\":\"1\",\"KES\":\"124.1\",\"GHS\":\"12.3\",\"NGN\":\"455.06\",\"GBP\":\"0.81\",\"EUR\":\"0.92\",\"TZS\":\"2335\"}', 1, 0, 1, '1-2 hours maximum', '2021-12-17 10:02:14', '2023-07-08 01:36:26'),
(1001, 'Razorpay', 'razorpay', 'Payment will receive within 1 days', '', NULL, '{\"account_number\":\"7878780080316316\",\"Key_Id\":\"rzp_test_kiOtejPbRZU90E\",\"Key_Secret\":\"osRDebzEqbsE1kbyQJ4y0re7\"}', '{\"webhook\":\"payout\"}', '64a912261ac0f1688801830.jpg', '10.00', '200000.00', '10.00', '1.00', 1, '{\"name\":{\"name\":\"name\",\"label\":\"Name\",\"type\":\"text\",\"validation\":\"required\"},\"email\":{\"name\":\"email\",\"label\":\"Email\",\"type\":\"text\",\"validation\":\"required\"},\"ifsc\":{\"name\":\"ifsc\",\"label\":\"IFSC\",\"type\":\"text\",\"validation\":\"required\"},\"account_number\":{\"name\":\"account_number\",\"label\":\"Account number\",\"type\":\"text\",\"validation\":\"required\"}}', '{\"INR\":\"INR\"}', '{\"INR\":\"INR\"}', '{\"INR\":\"70.98\"}', 1, 0, 1, '1-2 hours maximum', '2021-12-17 10:02:14', '2023-07-08 01:37:10'),
(1002, 'Paystack', 'paystack', 'Payment will receive within 1 days', '', NULL, '{\"Public_key\":\"pk_test_60368e68f65e34c4c3076334de0350fdb78c942b\",\"Secret_key\":\"sk_test_afe163363398a752b856d01e2b7be2554d9a2330\"}', '{\"webhook\":\"payout\"}', '64a9120f09adb1688801807.jpg', '10.00', '200000.00', '10.00', '1.00', 1, '{\"name\":{\"name\":\"name\",\"label\":\"Name\",\"type\":\"text\",\"validation\":\"required\"},\"account_number\":{\"name\":\"account_number\",\"label\":\"Account  Number\",\"type\":\"text\",\"validation\":\"required\"}}', '{\"NGN\":\"NGN\",\"GHS\":\"GHS\",\"ZAR\":\"ZAR\"}', '{\"NGN\":\"NGN\",\"GHS\":\"GHS\",\"ZAR\":\"ZAR\"}', '{\"NGN\":\"455\",\"GHS\":\"2.3\",\"ZAR\":\"17.2\"}', 1, 0, 1, '1-2 hours maximum', '2021-12-17 10:02:14', '2023-07-08 01:36:47'),
(1003, 'Coinbase', 'coinbase', 'Payment will receive within 1 days', '', NULL, '{\"API_Key\":\"5328e8ff2f7fe0bbc7fd6ea593038b08\",\"API_Secret\":\"ACWAncjv2fbMdvPfeJq9U\\/blqEx1FiItqbUGn+kEPCLbKGP4\\/iJlPIQDzMmJHHz\\/Inv1jYANsWDnh3RhHi6HLw==\",\"Api_Passphrase\":\"23xe3opufifi\"}', '{\"webhook\":\"payout\"}', '64a911e2ae88b1688801762.png', '10.00', '200000.00', '1.20', '1.00', 1, '{\"crypto_address\":{\"name\":\"crypto_address\",\"label\":\"Crypto Address\",\"type\":\"text\",\"validation\":\"required\"}}', '{\"BNB\":\"BNB\",\"BTC\":\"BTC\",\"XRP\":\"XRP\",\"ETH\":\"ETH\",\"ETH2\":\"ETH2\",\"USDT\":\"USDT\",\"BCH\":\"BCH\",\"LTC\":\"LTC\",\"XMR\":\"XMR\",\"TON\":\"TON\"}', '{\"BNB\":\"BNB\",\"BTC\":\"BTC\",\"XRP\":\"XRP\",\"ETH\":\"ETH\",\"ETH2\":\"ETH2\",\"USDT\":\"USDT\",\"BCH\":\"BCH\",\"LTC\":\"LTC\",\"XMR\":\"XMR\",\"TON\":\"TON\"}', '{\"BNB\":\"0.0032866584364651\",\"BTC\":\"4.3438047580189E-5\",\"XRP\":\"2.4317656276014\",\"ETH\":\"0.00060498363899103\",\"ETH2\":\"1\",\"USDT\":\"0.99970684227142\",\"BCH\":\"0.0077663435649339\",\"LTC\":\"0.011189496085365\",\"XMR\":\"0.0056633319909619\",\"TON\":\"0.43646828144729\"}', 1, 0, 1, '1-2 hours maximum', '2021-12-17 10:02:14', '2023-07-08 01:36:05'),
(1004, 'Perfect Money', 'perfectmoney', 'Payment will receive within 1 days', '', NULL, '{\"Passphrase\":\"45P7GN1T8TlRfMRAPCqLArVHz\",\"Account_ID\":\"90016052\",\"Payer_Account\":\"U41722458\"}', '', '64a9121aab5bd1688801818.jpg', '10.00', '200000.00', '10.00', '1.00', 1, '{\"account_number\":{\"name\":\"account_number\",\"label\":\"Account  Number\",\"type\":\"text\",\"validation\":\"required\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', '{\"USD\":\"1\",\"EUR\":\"0.93\"}', 1, 0, 1, '1-2 hours maximum', '2021-12-17 10:02:14', '2023-07-08 01:36:58'),
(1005, 'Paypal', 'paypal', 'Payment will receive within 1 days', '', NULL, '{\"cleint_id\":\"AUrvcotEVWZkksiGir6Ih4PyalQcguQgGN-7We5O1wBny3tg1w6srbQzi6GQEO8lP3yJVha2C6lyivK9\",\"secret\":\"EPx-YEgvjKDRFFu3FAsMue_iUMbMH6jHu408rHdn4iGrUCM8M12t7mX8hghUBAWwvWErBOa4Uppfp0Eh\"}', '{\"webhook\":\"payout\"}', '64a91204424f91688801796.png', '10.00', '200000.00', '10.00', '1.00', 1, '{\"receiver\":{\"name\":\"receiver\",\"label\":\"Receiver\",\"type\":\"text\",\"validation\":\"required\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"USD\"}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"USD\"}', '{\"AUD\":\"1.44\",\"BRL\":\"5.21\",\"CAD\":\"1.34\",\"CZK\":\"21.99\",\"DKK\":\"6.85\",\"EUR\":\"0.92\",\"HKD\":\"7.83\",\"HUF\":\"361.73\",\"INR\":\"80.98\",\"ILS\":\"3.4\",\"JPY\":\"129.56\",\"MYR\":\"4.29\",\"MXN\":\"18.87\",\"TWD\":\"30.33\",\"NZD\":\"1.55\",\"NOK\":\"9.79\",\"PHP\":\"54.46\",\"PLN\":\"4.14\",\"GBP\":\"0.81\",\"RUB\":\"68.25\",\"SGD\":\"1.32\",\"SEK\":\"10.3\",\"CHF\":\"0.92\",\"THB\":\"32.64\",\"USD\":\"1\"}', 1, 1, 1, '1-2 hours maximum', '2021-12-17 10:02:14', '2023-07-08 01:36:36'),
(1006, 'Binance', 'binance', 'Payment will receive within 1 days', '', NULL, '{\"API_Key\":\"u7UxJbqJvYKlhygtR0wlC5xOfWWIuNMUHqZrPXkwLC0neRRrC5HHq7CnbdKWacBI\",\"KEY_Secret\":\"5Z00Ecib1MBnGoHs2LxdqPCE4c4UvQ4vZKEweLmySWhvw5jM4BV2nnk0sWL9gNEL\"}', '', '64a9119db33511688801693.png', '10.00', '200000.00', '3.00', '2.00', 1, '{\"network\":{\"name\":\"network\",\"label\":\"Network\",\"type\":\"text\",\"validation\":\"required\"},\"address\":{\"name\":\"address\",\"label\":\"Address\",\"type\":\"text\",\"validation\":\"required\"}}', '{\"BNB\":\"BNB\",\"BTC\":\"BTC\",\"XRP\":\"XRP\",\"ETH\":\"ETH\",\"ETH2\":\"ETH2\",\"USDT\":\"USDT\",\"BCH\":\"BCH\",\"LTC\":\"LTC\",\"XMR\":\"XMR\",\"TON\":\"TON\"}', '{\"BNB\":\"BNB\",\"BTC\":\"BTC\",\"XRP\":\"XRP\",\"ETH\":\"ETH\",\"ETH2\":\"ETH2\",\"USDT\":\"USDT\",\"BCH\":\"BCH\",\"LTC\":\"LTC\",\"XMR\":\"XMR\",\"TON\":\"TON\"}', '{\"BNB\":\"0.0032866584364651\",\"BTC\":\"4.3438047580189E-5\",\"XRP\":\"2.4317656276014\",\"ETH\":\"0.00060498363899103\",\"ETH2\":\"1\",\"USDT\":\"0.99970684227142\",\"BCH\":\"0.0077663435649339\",\"LTC\":\"0.011189496085365\",\"XMR\":\"0.0056633319909619\",\"TON\":\"0.43646828144729\"}', 1, 1, 1, '1-2 hours maximum', '2021-12-17 10:02:14', '2023-07-08 01:36:15');");

    $output = new \Symfony\Component\Console\Output\BufferedOutput();
    Artisan::call('optimize:clear', array(), $output);
    return $output->fetch();
})->name('/clear');

Route::get('/user', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/loginModal', 'Auth\LoginController@loginModal')->name('loginModal');

Route::get('queue-work', function () {
    return Illuminate\Support\Facades\Artisan::call('queue:work', ['--stop-when-empty' => true]);
})->name('queue.work');

Route::get('cron', function () {
    return Illuminate\Support\Facades\Artisan::call('schedule:run');
})->name('cron');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['guest']], function () {
    Route::get('register/{sponsor?}', 'Auth\RegisterController@sponsor')->name('register.sponsor');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/check', 'User\VerificationController@check')->name('check');
    Route::get('/resend_code', 'User\VerificationController@resendCode')->name('resendCode');
    Route::post('/mail-verify', 'User\VerificationController@mailVerify')->name('mailVerify');
    Route::post('/sms-verify', 'User\VerificationController@smsVerify')->name('smsVerify');
    Route::post('twoFA-Verify', 'User\VerificationController@twoFAverify')->name('twoFA-Verify');
    Route::middleware('userCheck')->group(function () {
        Route::middleware('kyc')->group(function () {

            Route::get('/dashboard', 'User\HomeController@index')->name('home');

            Route::get('payment', 'User\HomeController@payment')->name('payment');
            Route::get('add-fund', 'User\HomeController@addFund')->name('addFund');
            Route::post('add-fund', 'PaymentController@addFundRequest')->name('addFund.request');
            Route::get('addFundConfirm', 'PaymentController@depositConfirm')->name('addFund.confirm');
            Route::post('addFundConfirm', 'PaymentController@fromSubmit')->name('addFund.fromSubmit');

            //transaction
            Route::get('/transaction', 'User\HomeController@transaction')->name('transaction');
            Route::get('/transaction-search', 'User\HomeController@transactionSearch')->name('transaction.search');
            Route::get('fund-history', 'User\HomeController@fundHistory')->name('fund-history');
            Route::get('fund-history-search', 'User\HomeController@fundHistorySearch')->name('fund-history.search');

            // TWO-FACTOR SECURITY
            Route::get('/twostep-security', 'User\HomeController@twoStepSecurity')->name('twostep.security');
            Route::post('twoStep-enable', 'User\HomeController@twoStepEnable')->name('twoStepEnable');
            Route::post('twoStep-disable', 'User\HomeController@twoStepDisable')->name('twoStepDisable');


            Route::get('push-notification-show', 'SiteNotificationController@show')->name('push.notification.show');
            Route::get('push.notification.readAll', 'SiteNotificationController@readAll')->name('push.notification.readAll');
            Route::get('push-notification-readAt/{id}', 'SiteNotificationController@readAt')->name('push.notification.readAt');


            Route::get('/payout', 'User\HomeController@payoutMoney')->name('payout.money');
            Route::post('/payout', 'User\HomeController@payoutMoneyRequest')->name('payout.moneyRequest');
            Route::get('/payout/preview', 'User\HomeController@payoutPreview')->name('payout.preview');
            Route::post('/payout/preview', 'User\HomeController@payoutRequestSubmit')->name('payout.submit');
            Route::post('/payout/paystack/{trx_id}', 'User\HomeController@paystackPayout')->name('payout.submit.paystack');
            Route::post('/payout/flutterwave/{trx_id}', 'User\HomeController@flutterwavePayout')->name('payout.submit.flutterwave');
            Route::post('withdraw-bank-list', 'User\HomeController@getBankList')->name('payout.getBankList');
            Route::post('withdraw-bank-from', 'User\HomeController@getBankForm')->name('payout.getBankFrom');


            Route::get('payout-history', 'User\HomeController@payoutHistory')->name('payout.history');
            Route::get('payout-history-search', 'User\HomeController@payoutHistorySearch')->name('payout.history.search');

            Route::get('invest-history', 'User\HomeController@investHistory')->name('invest-history');
            Route::post('/purchase-plan', 'User\HomeController@purchasePlan')->name('purchase-plan');


            Route::get('/referral', 'User\HomeController@referral')->name('referral');
            Route::get('/referral-bonus', 'User\HomeController@referralBonus')->name('referral.bonus');
            Route::get('/referral-bonus-search', 'User\HomeController@referralBonusSearch')->name('referral.bonus.search');
            Route::get('/badges', 'User\HomeController@badges')->name('badges');


            // money-transfer
            Route::get('/money-transfer', 'User\HomeController@moneyTransfer')->name('money-transfer');
            Route::post('/money-transfer', 'User\HomeController@moneyTransferConfirm')->name('money.transfer');

        });

        Route::get('/profile', 'User\HomeController@profile')->name('profile');
        Route::post('/updateProfile', 'User\HomeController@updateProfile')->name('updateProfile');
        Route::put('/updateInformation', 'User\HomeController@updateInformation')->name('updateInformation');
        Route::post('/updatePassword', 'User\HomeController@updatePassword')->name('updatePassword');

        Route::post('/verificationSubmit', 'User\HomeController@verificationSubmit')->name('verificationSubmit');
        Route::post('/addressVerification', 'User\HomeController@addressVerification')->name('addressVerification');


        Route::group(['prefix' => 'ticket', 'as' => 'ticket.'], function () {
            Route::get('/', 'User\SupportController@index')->name('list');
            Route::get('/create', 'User\SupportController@create')->name('create');
            Route::post('/create', 'User\SupportController@store')->name('store');
            Route::get('/view/{ticket}', 'User\SupportController@ticketView')->name('view');
            Route::put('/reply/{ticket}', 'User\SupportController@reply')->name('reply');
            Route::get('/download/{ticket}', 'User\SupportController@download')->name('download');
        });


    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', 'Admin\LoginController@showLoginForm')->name('login');
    Route::post('/', 'Admin\LoginController@login')->name('login');
    Route::post('/logout', 'Admin\LoginController@logout')->name('logout');

    Route::get('/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('password.update');

    Route::get('/403', 'Admin\DashboardController@forbidden')->name('403');

    Route::group(['middleware' => ['auth:admin', 'permission']], function () {
        Route::get('/dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');

        Route::get('/profile', 'Admin\DashboardController@profile')->name('profile');
        Route::put('/profile', 'Admin\DashboardController@profileUpdate')->name('profileUpdate');
        Route::get('/password', 'Admin\DashboardController@password')->name('password');
        Route::put('/password', 'Admin\DashboardController@passwordUpdate')->name('passwordUpdate');


        Route::get('/staff', 'Admin\ManageRolePermissionController@staff')->name('staff');
        Route::post('/staff', 'Admin\ManageRolePermissionController@storeStaff')->name('storeStaff');
        Route::put('/staff/{id}', 'Admin\ManageRolePermissionController@updateStaff')->name('updateStaff');

        Route::get('/identity-form', 'Admin\IdentyVerifyFromController@index')->name('identify-form');
        Route::post('/identity-form', 'Admin\IdentyVerifyFromController@store')->name('identify-form.store');
        Route::post('/identity-form/action', 'Admin\IdentyVerifyFromController@action')->name('identify-form.action');

        /*====== Manage Plan=======*/
        Route::get('/referral-commission', 'Admin\ManagePlanController@referralCommission')->name('referral-commission');
        Route::post('/referral-commission', 'Admin\ManagePlanController@referralCommissionStore')->name('referral-commission.store');
        Route::post('/referral-commission/action', 'Admin\ManagePlanController@referralCommissionAction')->name('referral-commission.action');
        // User Ranking
        Route::get('/user-rankings', 'Admin\ManagePlanController@rankingsUser')->name('rankingsUser');
        Route::get('/rank-create', 'Admin\ManagePlanController@rankCreate')->name('rankCreate');
        Route::post('/rank-store', 'Admin\ManagePlanController@rankStore')->name('rankStore');
        Route::get('rank-edit/{id}', 'Admin\ManagePlanController@rankEdit')->name('rankEdit');
        Route::post('/rank-update/{id}', 'Admin\ManagePlanController@rankUpdate')->name('rankUpdate');
        Route::delete('rank-delete/{id}', 'Admin\ManagePlanController@rankDelete')->name('rankDelete');

        Route::post('/sort-badges', 'Admin\ManagePlanController@sortBadges')->name('sort.badges');


        Route::get('/schedule-manage', 'Admin\ManagePlanController@scheduleManage')->name('scheduleManage');
        Route::post('/schedule-create', 'Admin\ManagePlanController@storeSchedule')->name('store.schedule');
        Route::put('/schedule-update/{id}', 'Admin\ManagePlanController@updateSchedule')->name('update.schedule');

        Route::get('/plan-list', 'Admin\ManagePlanController@planList')->name('planList');
        Route::get('/plan-create', 'Admin\ManagePlanController@planCreate')->name('planCreate');
        Route::post('/plan-create', 'Admin\ManagePlanController@planStore')->name('planStore');
        Route::get('/plan-edit/{id}', 'Admin\ManagePlanController@planEdit')->name('planEdit');
        Route::put('/plan-edit/{id}', 'Admin\ManagePlanController@planUpdate')->name('planUpdate');
        Route::post('/plans-active', 'Admin\ManagePlanController@activeMultiple')->name('plans-active');
        Route::post('/plans-inactive', 'Admin\ManagePlanController@inActiveMultiple')->name('plans-inactive');


        /* ====== Plugin =====*/
        Route::get('/plugin-config', 'Admin\BasicController@pluginConfig')->name('plugin.config');
        Route::match(['get', 'post'], 'tawk-config', 'Admin\BasicController@tawkConfig')->name('tawk.control');
        Route::match(['get', 'post'], 'fb-messenger-config', 'Admin\BasicController@fbMessengerConfig')->name('fb.messenger.control');
        Route::match(['get', 'post'], 'google-recaptcha', 'Admin\BasicController@googleRecaptchaConfig')->name('google.recaptcha.control');
        Route::match(['get', 'post'], 'google-analytics', 'Admin\BasicController@googleAnalyticsConfig')->name('google.analytics.control');
        Route::match(['get', 'post'], 'currency-exchange-api-config', 'Admin\BasicController@currencyExchangeApiConfig')->name('currency.exchange.api.config');


        /* ====== Transaction Log =====*/
        Route::get('/transaction', 'Admin\LogController@transaction')->name('transaction');
        Route::get('/transaction-search', 'Admin\LogController@transactionSearch')->name('transaction.search');

        Route::get('/investments', 'Admin\LogController@investments')->name('investments');
        Route::get('/investments-search', 'Admin\LogController@investmentsSearch')->name('investments.search');

        Route::get('/commissions', 'Admin\LogController@commissions')->name('commissions');
        Route::get('/commissions-search', 'Admin\LogController@commissionsSearch')->name('commissions.search');


        /*====Manage Users ====*/
        Route::get('/users', 'Admin\UsersController@index')->name('users');
        Route::get('/users/search', 'Admin\UsersController@search')->name('users.search');
        Route::post('/users-active', 'Admin\UsersController@activeMultiple')->name('user-multiple-active');
        Route::post('/users-inactive', 'Admin\UsersController@inactiveMultiple')->name('user-multiple-inactive');
        Route::get('/user/edit/{id}', 'Admin\UsersController@userEdit')->name('user-edit');
        Route::post('/user/update/{id}', 'Admin\UsersController@userUpdate')->name('user-update');
        Route::post('/user/password/{id}', 'Admin\UsersController@passwordUpdate')->name('userPasswordUpdate');
        Route::post('/user/balance-update/{id}', 'Admin\UsersController@userBalanceUpdate')->name('user-balance-update');

        Route::post('/user/badge-update/{id}', 'Admin\UsersController@badgeUpdate')->name('badgeUpdate');


        Route::get('/user/send-email/{id}', 'Admin\UsersController@sendEmail')->name('send-email');
        Route::post('/user/send-email/{id}', 'Admin\UsersController@sendMailUser')->name('user.email-send');
        Route::get('/user/transaction/{id}', 'Admin\UsersController@transaction')->name('user.transaction');
        Route::get('/user/fundLog/{id}', 'Admin\UsersController@funds')->name('user.fundLog');
        Route::get('/user/investmentLog/{id}', 'Admin\UsersController@investments')->name('user.plan-purchaseLog');
        Route::get('/user/payoutLog/{id}', 'Admin\UsersController@payoutLog')->name('user.withdrawal');
        Route::get('/user/commissionLog/{id}', 'Admin\UsersController@commissionLog')->name('user.commissionLog');
        Route::get('/user/referralMember/{id}', 'Admin\UsersController@referralMember')->name('user.referralMember');
        Route::post('/admin/login/as/user/{id}', 'Admin\UsersController@loginAsUser')->name('login-as-user');

        Route::get('users/kyc/pending', 'Admin\UsersController@kycPendingList')->name('kyc.users.pending');
        Route::get('users/kyc', 'Admin\UsersController@kycList')->name('kyc.users');
        Route::put('users/kycAction/{id}', 'Admin\UsersController@kycAction')->name('users.Kyc.action');
        Route::get('user/{user}/kyc', 'Admin\UsersController@userKycHistory')->name('user.userKycHistory');

        Route::get('/email-send', 'Admin\UsersController@emailToUsers')->name('email-send');
        Route::post('/email-send', 'Admin\UsersController@sendEmailToUsers')->name('email-send.store');


        /*=====Payment Log=====*/
        Route::get('payment-methods', 'Admin\PaymentMethodController@index')->name('payment.methods');
        Route::post('payment-methods/deactivate', 'Admin\PaymentMethodController@deactivate')->name('payment.methods.deactivate');
        Route::get('payment-methods/deactivate', 'Admin\PaymentMethodController@deactivate')->name('payment.methods.deactivate');
        Route::post('sort-payment-methods', 'Admin\PaymentMethodController@sortPaymentMethods')->name('sort.payment.methods');
        Route::get('payment-methods/edit/{id}', 'Admin\PaymentMethodController@edit')->name('edit.payment.methods');
        Route::put('payment-methods/update/{id}', 'Admin\PaymentMethodController@update')->name('update.payment.methods');


        // Manual Methods
        Route::get('payment-methods/manual', 'Admin\ManualGatewayController@index')->name('deposit.manual.index');
        Route::get('payment-methods/manual/new', 'Admin\ManualGatewayController@create')->name('deposit.manual.create');
        Route::post('payment-methods/manual/new', 'Admin\ManualGatewayController@store')->name('deposit.manual.store');
        Route::get('payment-methods/manual/edit/{id}', 'Admin\ManualGatewayController@edit')->name('deposit.manual.edit');
        Route::put('payment-methods/manual/update/{id}', 'Admin\ManualGatewayController@update')->name('deposit.manual.update');


        Route::get('payment/pending', 'Admin\PaymentLogController@pending')->name('payment.pending');
        Route::put('payment/action/{id}', 'Admin\PaymentLogController@action')->name('payment.action');
        Route::get('payment/log', 'Admin\PaymentLogController@index')->name('payment.log');
        Route::get('payment/search', 'Admin\PaymentLogController@search')->name('payment.search');

        Route::get('payout/settings', 'Admin\PayoutSettingsController@settings')->name('payout.settings');
        Route::post('payout/settings/action', 'Admin\PayoutSettingsController@settingsAction')->name('payout.settings.action');


        /*==========Payout Settings============*/
        Route::get('/payout-method', 'Admin\PayoutGatewayController@index')->name('payout-method');
        Route::get('/payout-method/create', 'Admin\PayoutGatewayController@create')->name('payout-method.create');
        Route::post('/payout-method/create', 'Admin\PayoutGatewayController@store')->name('payout-method.store');
        Route::get('/payout-method/{id}', 'Admin\PayoutGatewayController@edit')->name('payout-method.edit');
        Route::put('/payout-method/{id}', 'Admin\PayoutGatewayController@update')->name('payout-method.update');

        Route::get('/payout-log', 'Admin\PayoutRecordController@index')->name('payout-log');
        Route::get('/payout-log/search', 'Admin\PayoutRecordController@search')->name('payout-log.search');
        Route::get('/payout-request', 'Admin\PayoutRecordController@request')->name('payout-request');
        Route::get('/withdraw-view/{id}', 'Admin\PayoutRecordController@view')->name('payout-view');
        Route::post('/withdraw-confirm/{id}', 'Admin\PayoutRecordController@payoutConfirm')->name('payout-confirm');
        Route::post('/withdraw-cancel/{id}', 'Admin\PayoutRecordController@payoutCancel')->name('payout-cancel');


        /* ===== Support Ticket ====*/
        Route::get('tickets/{type?}', 'Admin\TicketController@tickets')->name('ticket');
        Route::get('tickets/view/{id}', 'Admin\TicketController@ticketReply')->name('ticket.view');
        Route::put('ticket/reply/{id}', 'Admin\TicketController@ticketReplySend')->name('ticket.reply');
        Route::get('ticket/download/{ticket}', 'Admin\TicketController@ticketDownload')->name('ticket.download');
        Route::post('ticket/delete', 'Admin\TicketController@ticketDelete')->name('ticket.delete');

        /* ===== Subscriber =====*/
        Route::get('subscriber', 'Admin\SubscriberController@index')->name('subscriber.index');
        Route::post('subscriber/remove', 'Admin\SubscriberController@remove')->name('subscriber.remove');
        Route::get('subscriber/send-email', 'Admin\SubscriberController@sendEmailForm')->name('subscriber.sendEmail');
        Route::post('subscriber/send-email', 'Admin\SubscriberController@sendEmail')->name('subscriber.mail');


        /* ===== website controls =====*/
        Route::any('/basic-controls', 'Admin\BasicController@index')->name('basic-controls');
        Route::post('/basic-controls', 'Admin\BasicController@updateConfigure')->name('basic-controls.update');

        Route::match(['get', 'post'], 'currency-exchange-api-config', 'Admin\BasicController@currencyExchangeApiConfig')->name('currency.exchange.api.config');

        Route::any('/email-controls', 'Admin\EmailTemplateController@emailControl')->name('email-controls');
        Route::post('/email-controls', 'Admin\EmailTemplateController@emailConfigure')->name('email-controls.update');
        Route::post('/email-controls/action', 'Admin\EmailTemplateController@emailControlAction')->name('email-controls.action');
        Route::post('/email/test', 'Admin\EmailTemplateController@testEmail')->name('testEmail');

        Route::get('/email-template', 'Admin\EmailTemplateController@show')->name('email-template.show');
        Route::get('/email-template/edit/{id}', 'Admin\EmailTemplateController@edit')->name('email-template.edit');
        Route::post('/email-template/update/{id}', 'Admin\EmailTemplateController@update')->name('email-template.update');

        /*========Sms control ========*/
        Route::match(['get', 'post'], '/sms-controls', 'Admin\SmsTemplateController@smsConfig')->name('sms.config');
        Route::post('/sms-controls/action', 'Admin\SmsTemplateController@smsControlAction')->name('sms-controls.action');
        Route::get('/sms-template', 'Admin\SmsTemplateController@show')->name('sms-template');
        Route::get('/sms-template/edit/{id}', 'Admin\SmsTemplateController@edit')->name('sms-template.edit');
        Route::post('/sms-template/update/{id}', 'Admin\SmsTemplateController@update')->name('sms-template.update');

        Route::get('/notify-config', 'Admin\NotifyController@notifyConfig')->name('notify-config');
        Route::post('/notify-config', 'Admin\NotifyController@notifyConfigUpdate')->name('notify-config.update');
        Route::get('/notify-template', 'Admin\NotifyController@show')->name('notify-template.show');
        Route::get('/notify-template/edit/{id}', 'Admin\NotifyController@edit')->name('notify-template.edit');
        Route::post('/notify-template/update/{id}', 'Admin\NotifyController@update')->name('notify-template.update');


        /* ===== ADMIN Language SETTINGS ===== */
        Route::get('language', 'Admin\LanguageController@index')->name('language.index');
        Route::get('language/create', 'Admin\LanguageController@create')->name('language.create');
        Route::post('language/create', 'Admin\LanguageController@store')->name('language.store');
        Route::get('language/{language}', 'Admin\LanguageController@edit')->name('language.edit');
        Route::put('language/{language}', 'Admin\LanguageController@update')->name('language.update');
        Route::delete('language/{language}', 'Admin\LanguageController@delete')->name('language.delete');
        Route::get('/language/keyword/{id}', 'Admin\LanguageController@keywordEdit')->name('language.keywordEdit');
        Route::put('/language/keyword/{id}', 'Admin\LanguageController@keywordUpdate')->name('language.keywordUpdate');
        Route::post('/language/importJson', 'Admin\LanguageController@importJson')->name('language.importJson');
        Route::post('store-key/{id}', 'Admin\LanguageController@storeKey')->name('language.storeKey');
        Route::put('update-key/{id}', 'Admin\LanguageController@updateKey')->name('language.updateKey');
        Route::delete('delete-key/{id}', 'Admin\LanguageController@deleteKey')->name('language.deleteKey');

        Route::get('/manage/theme', 'Admin\BasicController@manageTheme')->name('manage.theme');
        Route::put('/activate/theme/{name}', 'Admin\BasicController@activateTheme')->name('activate.themeUpdate');
        Route::get('/logo-seo', 'Admin\BasicController@logoSeo')->name('logo-seo');
        Route::put('/logoUpdate', 'Admin\BasicController@logoUpdate')->name('logoUpdate');
        Route::put('/seoUpdate', 'Admin\BasicController@seoUpdate')->name('seoUpdate');
        Route::get('/breadcrumb', 'Admin\BasicController@breadcrumb')->name('breadcrumb');
        Route::put('/breadcrumb', 'Admin\BasicController@breadcrumbUpdate')->name('breadcrumbUpdate');

        /* ===== ADMIN TEMPLATE SETTINGS ===== */
        Route::get('template/{section}', 'Admin\TemplateController@show')->name('template.show');
        Route::put('template/{section}/{language}', 'Admin\TemplateController@update')->name('template.update');
        Route::get('contents/{content}', 'Admin\ContentController@index')->name('content.index');
        Route::get('content-create/{content}', 'Admin\ContentController@create')->name('content.create');
        Route::put('content-create/{content}/{language?}', 'Admin\ContentController@store')->name('content.store');
        Route::get('content-show/{content}/{name?}', 'Admin\ContentController@show')->name('content.show');
        Route::put('content-update/{content}/{language?}', 'Admin\ContentController@update')->name('content.update');
        Route::delete('contents/{id}', 'Admin\ContentController@contentDelete')->name('content.delete');

        Route::get('push-notification-show', 'SiteNotificationController@showByAdmin')->name('push.notification.show');
        Route::get('push.notification.readAll', 'SiteNotificationController@readAllByAdmin')->name('push.notification.readAll');
        Route::get('push-notification-readAt/{id}', 'SiteNotificationController@readAt')->name('push.notification.readAt');
        Route::match(['get', 'post'], 'pusher-config', 'SiteNotificationController@pusherConfig')->name('pusher.config');
    });
});


Route::match(['get', 'post'], 'success', 'PaymentController@success')->name('success');
Route::match(['get', 'post'], 'failed', 'PaymentController@failed')->name('failed');
Route::match(['get', 'post'], 'payment/{code}/{trx?}/{type?}', 'PaymentController@gatewayIpn')->name('ipn');

Route::post('/khalti/payment/verify/{trx}', 'khaltiPaymentController@verifyPayment')->name('khalti.verifyPayment');
Route::post('/khalti/payment/store', 'khaltiPaymentController@storePayment')->name('khalti.storePayment');

Route::get('/language/{code?}', 'FrontendController@language')->name('language');

Route::get('/blog-details/{slug}/{id}', 'FrontendController@blogDetails')->name('blogDetails');
Route::get('/blog', 'FrontendController@blog')->name('blog');

Route::get('/', 'FrontendController@index')->name('home');
Route::get('/about', 'FrontendController@about')->name('about');
Route::get('/faq', 'FrontendController@faq')->name('faq');

Route::get('/plan', 'FrontendController@planList')->name('plan');

Route::get('/contact', 'FrontendController@contact')->name('contact');
Route::post('/contact', 'FrontendController@contactSend')->name('contact.send');

Route::post('/subscribe', 'FrontendController@subscribe')->name('subscribe');

Route::get('/{getLink}/{content_id}', 'FrontendController@getLink')->name('getLink');
