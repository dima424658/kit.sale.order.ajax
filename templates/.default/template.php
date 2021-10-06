<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

CModule::IncludeModule("kitgr.gurudelivery");

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var SaleOrderAjax $component
 * @var string $templateFolder
 */

$context = Main\Application::getInstance()->getContext();
$request = $context->getRequest();

if (empty($arParams['TEMPLATE_THEME']))
{
	$arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site')
{
	$templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
	$templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
	$arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', $component->getSiteId());
}

if (!empty($arParams['TEMPLATE_THEME']))
{
	if (!is_file(Main\Application::getDocumentRoot().'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
	{
		$arParams['TEMPLATE_THEME'] = 'blue';
	}
}

$arParams['ALLOW_USER_PROFILES'] = $arParams['ALLOW_USER_PROFILES'] === 'Y' ? 'Y' : 'N';
$arParams['SKIP_USELESS_BLOCK'] = $arParams['SKIP_USELESS_BLOCK'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['SHOW_ORDER_BUTTON']))
{
	$arParams['SHOW_ORDER_BUTTON'] = 'final_step';
}

$arParams['HIDE_ORDER_DESCRIPTION'] = isset($arParams['HIDE_ORDER_DESCRIPTION']) && $arParams['HIDE_ORDER_DESCRIPTION'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_TOTAL_ORDER_BUTTON'] = $arParams['SHOW_TOTAL_ORDER_BUTTON'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] = $arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_PAY_SYSTEM_INFO_NAME'] = $arParams['SHOW_PAY_SYSTEM_INFO_NAME'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_LIST_NAMES'] = $arParams['SHOW_DELIVERY_LIST_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_INFO_NAME'] = $arParams['SHOW_DELIVERY_INFO_NAME'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_PARENT_NAMES'] = $arParams['SHOW_DELIVERY_PARENT_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_STORES_IMAGES'] = $arParams['SHOW_STORES_IMAGES'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['BASKET_POSITION']) || !in_array($arParams['BASKET_POSITION'], array('before', 'after')))
{
	$arParams['BASKET_POSITION'] = 'after';
}

$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['SHOW_BASKET_HEADERS'] = $arParams['SHOW_BASKET_HEADERS'] === 'Y' ? 'Y' : 'N';
$arParams['HIDE_DETAIL_PAGE_URL'] = isset($arParams['HIDE_DETAIL_PAGE_URL']) && $arParams['HIDE_DETAIL_PAGE_URL'] === 'Y' ? 'Y' : 'N';
$arParams['DELIVERY_FADE_EXTRA_SERVICES'] = $arParams['DELIVERY_FADE_EXTRA_SERVICES'] === 'Y' ? 'Y' : 'N';

$arParams['SHOW_COUPONS'] = isset($arParams['SHOW_COUPONS']) && $arParams['SHOW_COUPONS'] === 'N' ? 'N' : 'Y';

if ($arParams['SHOW_COUPONS'] === 'N')
{
	$arParams['SHOW_COUPONS_BASKET'] = 'N';
	$arParams['SHOW_COUPONS_DELIVERY'] = 'N';
	$arParams['SHOW_COUPONS_PAY_SYSTEM'] = 'N';
}
else
{
	$arParams['SHOW_COUPONS_BASKET'] = isset($arParams['SHOW_COUPONS_BASKET']) && $arParams['SHOW_COUPONS_BASKET'] === 'N' ? 'N' : 'Y';
	$arParams['SHOW_COUPONS_DELIVERY'] = isset($arParams['SHOW_COUPONS_DELIVERY']) && $arParams['SHOW_COUPONS_DELIVERY'] === 'N' ? 'N' : 'Y';
	$arParams['SHOW_COUPONS_PAY_SYSTEM'] = isset($arParams['SHOW_COUPONS_PAY_SYSTEM']) && $arParams['SHOW_COUPONS_PAY_SYSTEM'] === 'N' ? 'N' : 'Y';
}

$arParams['SHOW_NEAREST_PICKUP'] = $arParams['SHOW_NEAREST_PICKUP'] === 'Y' ? 'Y' : 'N';
$arParams['DELIVERIES_PER_PAGE'] = isset($arParams['DELIVERIES_PER_PAGE']) ? intval($arParams['DELIVERIES_PER_PAGE']) : 9;
$arParams['PAY_SYSTEMS_PER_PAGE'] = isset($arParams['PAY_SYSTEMS_PER_PAGE']) ? intval($arParams['PAY_SYSTEMS_PER_PAGE']) : 9;
$arParams['PICKUPS_PER_PAGE'] = isset($arParams['PICKUPS_PER_PAGE']) ? intval($arParams['PICKUPS_PER_PAGE']) : 5;
$arParams['SHOW_PICKUP_MAP'] = $arParams['SHOW_PICKUP_MAP'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_MAP_IN_PROPS'] = $arParams['SHOW_MAP_IN_PROPS'] === 'Y' ? 'Y' : 'N';
$arParams['USE_YM_GOALS'] = $arParams['USE_YM_GOALS'] === 'Y' ? 'Y' : 'N';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

$useDefaultMessages = !isset($arParams['USE_CUSTOM_MAIN_MESSAGES']) || $arParams['USE_CUSTOM_MAIN_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_BLOCK_NAME']))
{
	$arParams['MESS_AUTH_BLOCK_NAME'] = Loc::getMessage('AUTH_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REG_BLOCK_NAME']))
{
	$arParams['MESS_REG_BLOCK_NAME'] = Loc::getMessage('REG_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BASKET_BLOCK_NAME']))
{
	$arParams['MESS_BASKET_BLOCK_NAME'] = Loc::getMessage('BASKET_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGION_BLOCK_NAME']))
{
	$arParams['MESS_REGION_BLOCK_NAME'] = Loc::getMessage('REGION_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PAYMENT_BLOCK_NAME']))
{
	$arParams['MESS_PAYMENT_BLOCK_NAME'] = Loc::getMessage('PAYMENT_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_BLOCK_NAME']))
{
	$arParams['MESS_DELIVERY_BLOCK_NAME'] = Loc::getMessage('DELIVERY_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BUYER_BLOCK_NAME']))
{
	$arParams['MESS_BUYER_BLOCK_NAME'] = Loc::getMessage('BUYER_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BACK']))
{
	$arParams['MESS_BACK'] = Loc::getMessage('BACK_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_FURTHER']))
{
	$arParams['MESS_FURTHER'] = Loc::getMessage('FURTHER_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_EDIT']))
{
	$arParams['MESS_EDIT'] = Loc::getMessage('EDIT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ORDER']))
{
	$arParams['MESS_ORDER'] = $arParams['~MESS_ORDER'] = Loc::getMessage('ORDER_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PRICE']))
{
	$arParams['MESS_PRICE'] = Loc::getMessage('PRICE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PERIOD']))
{
	$arParams['MESS_PERIOD'] = Loc::getMessage('PERIOD_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NAV_BACK']))
{
	$arParams['MESS_NAV_BACK'] = Loc::getMessage('NAV_BACK_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NAV_FORWARD']))
{
	$arParams['MESS_NAV_FORWARD'] = Loc::getMessage('NAV_FORWARD_DEFAULT');
}

$useDefaultMessages = !isset($arParams['USE_CUSTOM_ADDITIONAL_MESSAGES']) || $arParams['USE_CUSTOM_ADDITIONAL_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_PRICE_FREE']))
{
	$arParams['MESS_PRICE_FREE'] = Loc::getMessage('PRICE_FREE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ECONOMY']))
{
	$arParams['MESS_ECONOMY'] = Loc::getMessage('ECONOMY_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGISTRATION_REFERENCE']))
{
	$arParams['MESS_REGISTRATION_REFERENCE'] = Loc::getMessage('REGISTRATION_REFERENCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_1']))
{
	$arParams['MESS_AUTH_REFERENCE_1'] = Loc::getMessage('AUTH_REFERENCE_1_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_2']))
{
	$arParams['MESS_AUTH_REFERENCE_2'] = Loc::getMessage('AUTH_REFERENCE_2_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_3']))
{
	$arParams['MESS_AUTH_REFERENCE_3'] = Loc::getMessage('AUTH_REFERENCE_3_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ADDITIONAL_PROPS']))
{
	$arParams['MESS_ADDITIONAL_PROPS'] = Loc::getMessage('ADDITIONAL_PROPS_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_USE_COUPON']))
{
	$arParams['MESS_USE_COUPON'] = Loc::getMessage('USE_COUPON_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_COUPON']))
{
	$arParams['MESS_COUPON'] = Loc::getMessage('COUPON_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PERSON_TYPE']))
{
	$arParams['MESS_PERSON_TYPE'] = Loc::getMessage('PERSON_TYPE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SELECT_PROFILE']))
{
	$arParams['MESS_SELECT_PROFILE'] = Loc::getMessage('SELECT_PROFILE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGION_REFERENCE']))
{
	$arParams['MESS_REGION_REFERENCE'] = Loc::getMessage('REGION_REFERENCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PICKUP_LIST']))
{
	$arParams['MESS_PICKUP_LIST'] = Loc::getMessage('PICKUP_LIST_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NEAREST_PICKUP_LIST']))
{
	$arParams['MESS_NEAREST_PICKUP_LIST'] = Loc::getMessage('NEAREST_PICKUP_LIST_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SELECT_PICKUP']))
{
	$arParams['MESS_SELECT_PICKUP'] = Loc::getMessage('SELECT_PICKUP_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_INNER_PS_BALANCE']))
{
	$arParams['MESS_INNER_PS_BALANCE'] = Loc::getMessage('INNER_PS_BALANCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ORDER_DESC']))
{
	$arParams['MESS_ORDER_DESC'] = Loc::getMessage('ORDER_DESC_DEFAULT');
}

$useDefaultMessages = !isset($arParams['USE_CUSTOM_ERROR_MESSAGES']) || $arParams['USE_CUSTOM_ERROR_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_PRELOAD_ORDER_TITLE']))
{
	$arParams['MESS_PRELOAD_ORDER_TITLE'] = Loc::getMessage('PRELOAD_ORDER_TITLE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SUCCESS_PRELOAD_TEXT']))
{
	$arParams['MESS_SUCCESS_PRELOAD_TEXT'] = Loc::getMessage('SUCCESS_PRELOAD_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_FAIL_PRELOAD_TEXT']))
{
	$arParams['MESS_FAIL_PRELOAD_TEXT'] = Loc::getMessage('FAIL_PRELOAD_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_CALC_ERROR_TITLE']))
{
	$arParams['MESS_DELIVERY_CALC_ERROR_TITLE'] = Loc::getMessage('DELIVERY_CALC_ERROR_TITLE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_CALC_ERROR_TEXT']))
{
	$arParams['MESS_DELIVERY_CALC_ERROR_TEXT'] = Loc::getMessage('DELIVERY_CALC_ERROR_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR']))
{
	$arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR'] = Loc::getMessage('PAY_SYSTEM_PAYABLE_ERROR_DEFAULT');
}

$scheme = $request->isHttps() ? 'https' : 'http';

switch (LANGUAGE_ID)
{
	case 'ru':
		$locale = 'ru-RU'; break;
	case 'ua':
		$locale = 'ru-UA'; break;
	case 'tk':
		$locale = 'tr-TR'; break;
	default:
		$locale = 'en-US'; break;
}

$this->addExternalCss('/bitrix/css/main/bootstrap.css');
$APPLICATION->SetAdditionalCSS('/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css', true);
$APPLICATION->SetAdditionalCSS($templateFolder.'/style.css', true);
$this->addExternalJs($templateFolder.'/order_ajax.js');
\Bitrix\Sale\PropertyValueCollection::initJs();
$this->addExternalJs($templateFolder.'/script.js');
?>
	<NOSCRIPT>
		<div style="color:red"><?=Loc::getMessage('SOA_NO_JS')?></div>
	</NOSCRIPT>
<?

if ($request->get('ORDER_ID') <> '')
{
	include(Main\Application::getDocumentRoot().$templateFolder.'/confirm.php');
}
elseif ($arParams['DISABLE_BASKET_REDIRECT'] === 'Y' && $arResult['SHOW_EMPTY_BASKET'])
{
	include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}
else
{
	Main\UI\Extension::load('phone_auth');

	$hideDelivery = empty($arResult['DELIVERY']);
	?>
	<form action="<?=POST_FORM_ACTION_URI?>" method="POST" name="ORDER_FORM" id="bx-soa-order-form" enctype="multipart/form-data">
		<?
		echo bitrix_sessid_post();

		if ($arResult['PREPAY_ADIT_FIELDS'] <> '')
		{
			echo $arResult['PREPAY_ADIT_FIELDS'];
		}

 /*
       unset($_SESSION['guru_user_delivery_address']);
        unset($_SESSION['guru_delivery_address']);
        unset($_SESSION['guru_delivery_city']);

        unset($_SESSION['guru_delivery_index']);

        unset($_SESSION['guru_check_delivery_address']);
        unset($_SESSION['guru_delivery_location']);
        unset($_SESSION['guru_delivery_zip']);
        unset($_SESSION['guru_delivery_room']);

        unset($_SESSION['guru_delivery_pvz']);
*/

        $guru_props = array();
        $not_guru_props = array();

        $dbProps = CSaleOrderProps::GetList(array("ID" => "ASC"), array(), false, false, array("ID", "CODE","PERSON_TYPE_ID"));
        while($check_prop = $dbProps->fetch())
        {
                if( (strpos($check_prop["CODE"], "GURU_") !== False) && (strpos($check_prop["CODE"], "GURU_") == 0) ) $guru_props[$check_prop["CODE"]][$check_prop["PERSON_TYPE_ID"]] = $check_prop["ID"];
                else $not_guru_props[$check_prop["CODE"]][$check_prop["PERSON_TYPE_ID"]] = $check_prop["ID"];
        }

		?>
		<input type="hidden" name="<?=$arParams['ACTION_VARIABLE']?>" value="saveOrderAjax">
		<input type="hidden" name="location_type" value="code">
		<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult['BUYER_STORE']?>">
		<div id="bx-soa-order" class="row bx-<?=$arParams['TEMPLATE_THEME']?>" style="opacity: 0">
			<!--	MAIN BLOCK	-->
			<div class="col-sm-9 bx-soa">
				<div id="bx-soa-main-notifications">
					<div class="alert alert-danger" style="display:none"></div>
					<div data-type="informer" style="display:none"></div>
				</div>
				<!--	AUTH BLOCK	-->
				<div id="bx-soa-auth" class="bx-soa-section bx-soa-auth" style="display:none">
					<div class="bx-soa-section-title-container">
						<h2 class="bx-soa-section-title col-sm-9">
							<span class="bx-soa-section-title-count"></span><?=$arParams['MESS_AUTH_BLOCK_NAME']?>
						</h2>
					</div>
					<div class="bx-soa-section-content container-fluid"></div>
				</div>

				<!--	DUPLICATE MOBILE ORDER SAVE BLOCK	-->
				<div id="bx-soa-total-mobile" style="margin-bottom: 6px;"></div>

				<? if ($arParams['BASKET_POSITION'] === 'before'): ?>
					<!--	BASKET ITEMS BLOCK	-->
					<div id="bx-soa-basket" data-visited="false" class="bx-soa-section bx-active">
						<div class="bx-soa-section-title-container">
							<h2 class="bx-soa-section-title col-sm-9">
								<span class="bx-soa-section-title-count"></span><?=$arParams['MESS_BASKET_BLOCK_NAME']?>
							</h2>
							<div class="col-xs-12 col-sm-3 text-right"><a href="javascript:void(0)" class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
						</div>
						<div class="bx-soa-section-content container-fluid"></div>
					</div>
				<? endif ?>

                <style>
<?
                foreach($guru_props as $guru_prop)
                {
		foreach($guru_prop as $guru_subprop)
		{
?>
                    DIV[data-property-id-row="<?=$guru_subprop?>"] {
                        display: none;
                    }
<?
		}
                }
?>

                    .guru_map_hidden{
                        position: absolute;
                        visibility: hidden;
                        width: 100%
                    }

                    #post_thanks {
                        display: none;
                        color: red;
                    }

                    #courier_thanks {
                        display: none;
                        color: red;
                    }

                    .GuruChDeliveryButtonContainer {
                        width: 100%;
                        text-align: center;
                    }

                    .GuruChDeliveryButton {
                        border: 2px solid rgb(135, 199, 61);
                        width: 30%;
                        background-color: rgb(165, 231, 81);
                    }

	<?foreach($not_guru_props['LOCATION'] as $location){?>
	DIV[data-property-id-row="<?=$location?>"] {
                        display: none
                    }
	<?}?>

                    .col-sm-9 .bx-soa-pp-company-selected {
                        display: none
                    }

                    .bx-soa-pp-price {
                        display: none;
                    }

                    #guru_courier_params {
                        display: none;
                        padding: 8px 13px 7px;
                    }

                    .delivery-add-params {
                        padding: 8px 13px 7px;
                    }

                    #no-house-warning {
                        display: none;
                    }

                    #guru_post_params {
                        display: none;
                    }

                    .pre-input {
                        width: 250px;
                        height: 30px;
                        display: inline-block;
                    }

                    #night-courier {
                        display: none;
                    }

                    #no-room-warning-courier {
                        display: none;
                        color: red;
                    }

                    #no-room-warning-post {
                        display: none;
                        color: red;
                    }
                </style>

				<!--	REGION BLOCK	-->
				<div id="bx-soa-region" data-visited="false" class="bx-soa-section bx-active">
					<div class="bx-soa-section-title-container">
						<h2 class="bx-soa-section-title col-sm-9">
							<span class="bx-soa-section-title-count"></span><?=$arParams['MESS_REGION_BLOCK_NAME']?>
						</h2>
						<div class="col-xs-12 col-sm-3 text-right"><a href="" class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
					</div>
                        <div id="guru_address" class="guru_delivery_data">
                            <div style="padding: 8px 13px 7px;"><?=Loc::getMessage('SHOW_YOUR_PLACE')?></div>
                            <?
                            $APPLICATION->IncludeComponent(
                                "kit:dostavka.guru.address",
                                ".default",
                                Array(
                                ),
                                false
                            );
                            ?>
                        </div>
                        <span id="no-house-warning"><? echo Loc::getMessage('ENTER_ADDRESS'); ?></span>
					<div class="bx-soa-section-content container-fluid"></div>
				</div>

				<? if ($arParams['DELIVERY_TO_PAYSYSTEM'] === 'p2d'): ?>
					<!--	PAY SYSTEMS BLOCK	-->
					<div id="bx-soa-paysystem" data-visited="false" class="bx-soa-section bx-active">
						<div class="bx-soa-section-title-container">
							<h2 class="bx-soa-section-title col-sm-9">
								<span class="bx-soa-section-title-count"></span><?=$arParams['MESS_PAYMENT_BLOCK_NAME']?>
							</h2>
							<div class="col-xs-12 col-sm-3 text-right"><a href="" class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
						</div>
						<div class="bx-soa-section-content container-fluid"></div>
					</div>
					<!--	DELIVERY BLOCK	-->
					<div id="bx-soa-delivery" data-visited="false" class="bx-soa-section bx-active" <?=($hideDelivery ? 'style="display:none"' : '')?>>
						<div class="bx-soa-section-title-container">
							<h2 class="bx-soa-section-title col-sm-9">
								<span class="bx-soa-section-title-count"></span><?=$arParams['MESS_DELIVERY_BLOCK_NAME']?>
							</h2>
							<div class="col-xs-12 col-sm-3 text-right"><a href="" class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
						</div>
						<div class="bx-soa-section-content container-fluid"></div>
					</div>
					<!--	PICKUP BLOCK	-->
					<div id="bx-soa-pickup" data-visited="false" class="bx-soa-section" style="display:none">
						<div class="bx-soa-section-title-container">
							<h2 class="bx-soa-section-title col-sm-9">
								<span class="bx-soa-section-title-count"></span>
							</h2>
							<div class="col-xs-12 col-sm-3 text-right"><a href="" class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
						</div>
						<div class="bx-soa-section-content container-fluid"></div>
					</div>
				<? else: ?>
					<!--	DELIVERY BLOCK	-->
					<div id="bx-soa-delivery" data-visited="false" class="bx-soa-section bx-active" <?=($hideDelivery ? 'style="display:none"' : '')?>>
						<div class="bx-soa-section-title-container">
							<h2 class="bx-soa-section-title col-sm-9">
								<span class="bx-soa-section-title-count"></span><?=$arParams['MESS_DELIVERY_BLOCK_NAME']?>
							</h2>
							<div class="col-xs-12 col-sm-3 text-right"><a href="" class="bx-soa-editstep" id='guru-delivery-edit'><?=$arParams['MESS_EDIT']?></a></div>
						</div>
						<div class="bx-soa-section-content container-fluid"></div>
                        <?
                        $delivery_pvz_id = 0;

                        for ($i = 0; $i < count($arResult['JS_DATA']['ORDER_PROP']['properties']); $i++) {
                            if ($arResult['JS_DATA']['ORDER_PROP']['properties'][$i]["CODE"] == "GURU_FIO")
                                $arResult['JS_DATA']['ORDER_PROP']['properties'][$i]['VALUE'][0] = $arResult['JS_DATA']['ORDER_PROP']['properties'][0]['VALUE'][0];
                            if ($arResult['JS_DATA']['ORDER_PROP']['properties'][$i]["CODE"] == "GURU_PHONE")
                                $arResult['JS_DATA']['ORDER_PROP']['properties'][$i]['VALUE'][0] = $arResult['JS_DATA']['ORDER_PROP']['properties'][2]['VALUE'][0];

                        }

                        $arParams['USER_CONSENT_IS_CHECKED'] = 'N';
                        ?>

                        <div id="guru_map" class="guru_delivery_data guru_map_hidden">
                            <?
                            echo Loc::getMessage('SELECT_PVZ');
                            $APPLICATION->IncludeComponent(
                                "kit:dostavka.guru.map",
                                ".default",
                                Array(
                                ),
                                false
                            );
                            ?>
                            <!--<iframe src="/bitrix/components/bitrix/sale.o666rder.ajax/templates/.default/map_frame.php" id="mapframeid" width="100%">\CA\E0\F0\F2\E0</iframe>-->
                        </div>
                        <div id="guru_pvz_data"></div>
                        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                        <script>
                            $(document).ready(function () {
		<?foreach($guru_props['GURU_FIO'] as $fio) {?>
                                    if($("[data-property-id-row=<?=$fio?>]")) $("[data-property-id-row=<?=$fio?>]").before('<input type="checkbox" id="show_recipient" name="show_recipient_name" value="Y"><span style="padding: 0px 4px;"><?=Loc::getMessage('FILL_RECEIVER')?></span>');
		<?}?>
                            });
                            $(document).on('click', '#show_recipient', function () {
                                if ($("#show_recipient").prop('checked')) {
		<?foreach($guru_props['GURU_FIO'] as $fio) {?>
                                    if($("[data-property-id-row=<?=$fio?>]")) $("[data-property-id-row=<?=$fio?>]").show();
		<?}?>
		<?foreach($guru_props['GURU_PHONE'] as $phone) {?>
                                    if($("[data-property-id-row=<?=$phone?>]")) $("[data-property-id-row=<?=$phone?>]").show();
		<?}?>
		<?foreach($guru_props['GURU_FIO'] as $fio) {?>
			if($("#soa-property-<?=$fio?>")) $("#soa-property-<?=$fio?>").attr("placeholder", "");
		<?}?>
		<?foreach($guru_props['GURU_PHONE'] as $phone) {?>
			if($("#soa-property-<?=$phone?>")) $("#soa-property-<?=$phone?>").attr("placeholder", "");
		<?}?>
                                } else {
		<?foreach($guru_props['GURU_FIO'] as $fio) {?>
                                    if($("[data-property-id-row=<?=$fio?>]")) $("[data-property-id-row=<?=$fio?>]").hide();
		<?}?>
		<?foreach($guru_props['GURU_PHONE'] as $phone) {?>
                                    if($("[data-property-id-row=<?=$phone?>]")) $("[data-property-id-row=<?=$phone?>]").hide();
		<?}?>
                                }
                            });

                            $(function () {
                                $("#datepicker").datepicker({
                                    timepicker: false,
                                    dateFormat: 'dd.mm.yy',
                                    minDate : "+1"
                                });
                            });


                            function setPeriods() {

                                var city = $('#guru_address_button_id').attr('courier_city');

                                if (city != '<?=MOSCOW?>') {
                                    $('#guru_courier_type option[value="<?=Loc::getMessage('NIGHT_DELIVERY')?>"]').prop("disabled", true);
                                }
                                else {
                                    $('#guru_courier_type option[value="<?=Loc::getMessage('NIGHT_DELIVERY')?>"]').prop("disabled", false);
                                }

                                if ((city != '<?=MOSCOW?>') && (city != '<?=SAINT_PETERSBURG?>')) {

                                    $('#guru_period_start option[value=10]').prop('selected', true);
                                    $('#guru_period_finish option[value=14]').prop('selected', true);
                                    $('#guru_period_start').prop('disabled', true);
                                    $('#guru_period_finish').prop('disabled', true);

                                } else {

                                    $('#guru_period_start').prop('disabled', false);
                                    $('#guru_period_finish').prop('disabled', false);
                                    var deldate = $('#datepicker').val();
                                    var dy, dm, dd;
                                    dd = deldate.substring(0, 2);
                                    dm = deldate.substring(3, 5);
                                    dy = deldate.substring(6);
                                    var normalizedDate = new Date(dy, dm, dd);
                                    var dayNum = normalizedDate.getDay();


                                    if (dayNum == 2) {
                                        var guru_period_start = '<option value="10" selected>10.00</option><option value="14">14.00</option>';
                                        var guru_period_finish = '<option value="14" selected>14.00</option><option value="18">18.00</option>';
                                        document.getElementById('guru_period_start').innerHTML = guru_period_start;
                                        document.getElementById('guru_period_finish').innerHTML = guru_period_finish;
                                    } else {
                                        if (dayNum == 3) {
                                            $('#guru_period_start option[value=10]').prop('selected', true);
                                            $('#guru_period_finish option[value=14]').prop('selected', true);
                                            $('#guru_period_start').prop('disabled', true);
                                            $('#guru_period_finish').prop('disabled', true);
                                        } else {
                                            document.getElementById('guru_period_start').innerHTML = delfromcontent;
                                            document.getElementById('guru_period_finish').innerHTML = deltocontent;
                                        }
                                    }


                                }

                            }
                        </script>
                        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                        <style>
                            .ui-datepicker {
                                z-index: 100 !important;
                            }
                        </style>
                        <input type="hidden" id="guru_courier_address" value="">
                        <input type="hidden" id="guru_post_address" value="">
                        <input type="hidden" id="guru_pvz_chosen_address" value="">
                        <input type="hidden" id="go_next" value="N">
                        <div id="guru_courier_params">
                            <p id="no-room-warning-courier"><? echo Loc::getMessage('FILL_REQ'); ?></p>
                            <span class="pre-input"><? echo Loc::getMessage('SELECT_TYPE'); ?></span>
                            <select id="guru_courier_type" onchange="changeType();">
                                <option value='<? echo Loc::getMessage('KDELIVERY'); ?>'
                                        selected><? echo Loc::getMessage('KDELIVERY'); ?></option>
                                <option value='<? echo Loc::getMessage('EXDELIVERY'); ?>'><? echo Loc::getMessage('EXDELIVERY'); ?></option>
                                <option value='<? echo Loc::getMessage('NIGHT_DELIVERY'); ?>'><? echo Loc::getMessage('NIGHT_DELIVERY'); ?></option>
                            </select>
                            </br>
                            <div id="room-input-courier"><span
                                        class="pre-input"><? echo Loc::getMessage('APNUM'); ?>:<span
                                            style="color:red">*</span> </span><input type="text"
                                                                                     class="delivery-add-params"
                                                                                     id="courier-room"></br></br></div>
                            <span class="pre-input"><? echo Loc::getMessage('ENTRANCE'); ?>: </span><input type="text"
                                                                                                           class="delivery-add-params"
                                                                                                           id="courier-entrance"></br></br>
                            <span class="pre-input"><? echo Loc::getMessage('HOME_PHONE'); ?>:</span><input type="text"
                                                                                                            class="delivery-add-params"
                                                                                                            id="courier-intercom"></br></br>
                            <span class="pre-input"><? echo Loc::getMessage('STAGE'); ?>: </span><input type="text"
                                                                                                        class="delivery-add-params"
                                                                                                        id="courier-level"></br></br>
							<span class="pre-input"><? echo Loc::getMessage('RECEIVER'); ?>: </span><input type="text"
                                                                                                        class="delivery-add-params"
                                                                                                        id="courier-reciever"></br></br>
                            <span class="pre-input"><? echo Loc::getMessage('SELECT_DELIVERY_DATE'); ?>:<span
                                        style="color:red">*</span> </span><input type="text" id="datepicker" autocomplete="off" onChange="setPeriods();">
                            <br>
                            <div id="day-courier">
                                <? echo Loc::getMessage('DELFROM'); ?>&nbsp;<select name="start" id="guru_period_start"
                                                                                    onchange="changeStart();">
                                    <?
                                    for ($i = 10; $i <= 18; $i++) {
                                        $selected = "";
                                        if ($i == 10)
                                            $selected = "selected";
                                        ?>
                                        <option value="<?= $i ?>" <?= $selected ?>><?= $i ?>.00</option>
                                        <?
                                    }
                                    ?>
                                </select>
                                <script>
                                    var delfromcontent =  document.getElementById('guru_period_start').innerHTML;


                                </script>
                                <? echo Loc::getMessage('DELTO'); ?>&nbsp;<select name="finish" id="guru_period_finish"
                                                                                  onchange="changeFinish();">
                                    <?
                                    for ($i = 13; $i <= 21; $i++) {
                                        $selected = "";
                                        if ($i == 18)
                                            $selected = "selected";
                                        ?>
                                        <option value="<?= $i ?>" <?= $selected ?>><?= $i ?>.00</option>
                                        <?
                                    }
                                    ?>
                                </select>
                                <script>
                                    var deltocontent =  document.getElementById('guru_period_finish').innerHTML;


                                </script>
                            </div>
                            <div id="night-courier">
                                <p style="color: red;"><? echo Loc::getMessage('EVENING_DELIVERY'); ?></p>
                                <? echo Loc::getMessage('DELFROM'); ?>&nbsp;<select name="start"
                                                                                    id="guru_night_period_start"
                                                                                    onchange="changeStartNight();">
                                        <option value="22" selected>22.00</option>
                                        <option value="2">2.00</option>
                                </select>
                                <? echo Loc::getMessage('DELTO'); ?>&nbsp;<select name="finish"
                                                                                  id="guru_night_period_finish"
                                                                                  onchange="changeFinishNight();">
                                        <option value="2" selected>2.00</option>
                                        <option value="6">6.00</option>
                                </select>
                            </div>
                            <input class="guru_address_button" id="guru_courier_button_id" type="button"
                                   value="<? echo Loc::getMessage('BUTTON_SAVE'); ?>"></input></br>
                            <p id="courier_thanks"><? echo Loc::getMessage('ADDRESS_SAVED'); ?></p>
                        </div>
                        <script>

                            function changeStart() {
                                var deldate = $('#datepicker').val();
                                var dy, dm, dd;
                                dd = deldate.substring(0, 2);
                                dm = deldate.substring(3, 5);
                                dy = deldate.substring(6);
                                var normalizedDate = new Date(dy, dm, dd);
                                var dayNum = normalizedDate.getDay();
                                if (dayNum != 2) {
                                    var selected = parseInt($("#guru_period_start").val());
                                    var selected2 = parseInt($("#guru_period_finish").val());
                                    if (selected2 - selected < 3) {
                                        var result = selected + 3;
                                        $("#guru_period_finish").val(result);
                                    }
                                } else {
                                    if ($("#guru_period_start").val() == 10) $("#guru_period_finish").val(14);
                                    else $("#guru_period_finish").val(18);
                                }
                            }

                            function changeFinish() {
                                var deldate = $('#datepicker').val();
                                var dy, dm, dd;
                                dd = deldate.substring(0, 2);
                                dm = deldate.substring(3, 5);
                                dy = deldate.substring(6);
                                var normalizedDate = new Date(dy, dm, dd);
                                var dayNum = normalizedDate.getDay();
                                if (dayNum != 2) {
                                    var selected = parseInt($("#guru_period_start").val());
                                    var selected2 = parseInt($("#guru_period_finish").val());
                                    if (selected2 - selected < 3) {
                                        var result = selected2 - 3;
                                        $("#guru_period_start").val(result);
                                    }
                                } else {
                                    if ($("#guru_period_finish").val() == 14) $("#guru_period_start").val(10);
                                    else $("#guru_period_start").val(14);
                                }
                            }

                            function changeStartNight() {
                                var selected = parseInt($("#guru_night_period_start").val());
                                var selected2 = parseInt($("#guru_night_period_finish").val());
                                if (selected2 - selected < 3) {
                                    var result = selected + 3;
                                    $("#guru_night_period_finish").val(result);
                                }
                            }

                            function changeFinishNight() {
                                var selected = parseInt($("#guru_night_period_start").val());
                                var selected2 = parseInt($("#guru_night_period_finish").val());
                                if (selected2 - selected < 3) {
                                    var result = selected2 - 3;
                                    $("#guru_night_period_start").val(result);
                                }
                            }

                            function changeType() {
                                var selected = $("#guru_courier_type").val();
                                if (selected == '<?=Loc::getMessage('NIGHT_DELIVERY')?>') {
                                    document.getElementById('night-courier').style.display = 'block';
                                    document.getElementById('day-courier').style.display = 'none';
                                } else {
                                    document.getElementById('night-courier').style.display = 'none';
                                    document.getElementById('day-courier').style.display = 'block';
                                }
                            }

                            $(document).on('click', '#guru_courier_button_id', function () {
                                if (!$('#datepicker').val() || !$("#courier-room").val()) {
                                    document.getElementById('no-room-warning-courier').style.display = 'block';
		<?foreach($not_guru_props['ADDRESS'] as $address){?>
                                    if(document.getElementById('soa-property-<?=$address?>')) document.getElementById('soa-property-<?=$address?>').value = '';
		<?}?>
                                    document.getElementById('guru_pvz_chosen_address').value = '';
                                    document.getElementById('guru_courier_address').value = '';
                                    document.getElementById('guru_post_address').value = '';
                                    document.getElementById('go_next').value = 'N';
                                    document.getElementById('courier_thanks').style.display = 'none';
                                    return false;
                                }
                                document.getElementById('no-room-warning-courier').style.display = 'none';
                                var address_array = $('#guru_address_button_id').attr('courier_address').split(':');
                                address_array[3] = $("#guru_courier_type").val();
                                address_array[4] = $('#datepicker').val();
                                if (address_array[3] == '<?=Loc::getMessage('NIGHT_DELIVERY')?>') {
                                    address_array[5] = $("#guru_night_period_start").val() + '_' + $("#guru_night_period_finish").val();
                                } else {
                                    address_array[5] = $("#guru_period_start").val() + '_' + $("#guru_period_finish").val();
                                }
                                address_array[6] = $("#courier-room").val();
                                address_array[7] = $("#courier-entrance").val();
                                address_array[8] = $("#courier-intercom").val();
                                address_array[9] = $("#courier-level").val();
                                address_array[10] = $('#guru_address_button_id').attr('location');
                                address_array[11] = $('#guru_address_button_id').attr('courier_city');

                                $.ajax({
                                	url: '/local/php_interface/include/save_fio.php',
                                	type: "POST",
                                	data: {fio: $("#courier-reciever").val()},
                                	success: function (result) {
                                	}
                                });
		<?foreach($not_guru_props['ADDRESS'] as $address){?>
                                if(document.getElementById('soa-property-<?=$address?>')) document.getElementById('soa-property-<?=$address?>').value = address_array.join(':');
		<?}?>
                                document.getElementById('guru_courier_address').value = address_array.join(':');
                                document.getElementById('go_next').value = 'Y';
                                if (!document.getElementById('post-room').value) document.getElementById('post-room').value = $("#courier-room").val();
                                document.getElementById('courier_thanks').style.display = 'block';
                            });
                            $(document).on('click', '#guru_post_button_id', function () {
                                if (!$("#post-room").val()) {
                                    document.getElementById('no-room-warning-post').style.display = 'block';
		<?foreach($not_guru_props['ADDRESS'] as $address){?>
                                    if(document.getElementById('soa-property-<?=$address?>')) document.getElementById('soa-property-<?=$address?>').value = '';
		<?}?>
                                    document.getElementById('guru_pvz_chosen_address').value = '';
                                    document.getElementById('guru_courier_address').value = '';
                                    document.getElementById('guru_post_address').value = '';
                                    document.getElementById('go_next').value = 'N';
                                    document.getElementById('post_thanks').style.display = 'none';
                                    return false;
                                }
                                document.getElementById('no-room-warning-post').style.display = 'none';
                                var address_array = $('#guru_address_button_id').attr('courier_address').split(':');
                                address_array[3] = $("#post-room").val();
                                address_array[4] = $('#guru_address_button_id').attr('location');
                                address_array[5] = $('#guru_address_button_id').attr('courier_city');
		<?foreach($not_guru_props['ADDRESS'] as $address){?>
                                if(document.getElementById('soa-property-<?=$address?>')) document.getElementById('soa-property-<?=$address?>').value = address_array.join(':');
		<?}?>
                                document.getElementById('guru_post_address').value = address_array.join(':');
                                if (!document.getElementById('courier-room').value) document.getElementById('courier-room').value = $("#post-room").val();
                                document.getElementById('go_next').value = 'Y';
                                document.getElementById('post_thanks').style.display = 'block';
                            });
                        </script>
                        <div id="guru_post_params">
                            <p id="no-room-warning-post"><? echo Loc::getMessage('FILL_REQ'); ?></p>
                            <div id="room-input-post" style="padding: 8px 13px 7px;"><span class="pre-input"><? echo Loc::getMessage('APNUM'); ?>:<span
                                            style="color:red">*</span> </span><input type="text"
                                                                                     class="delivery-add-params"
                                                                                     id="post-room"></br><!--</div>-->
                                <input class="guru_address_button" id="guru_post_button_id" type="button"
                                       value="<? echo Loc::getMessage('BUTTON_SAVE'); ?>"></input>
                                <p id="post_thanks"><? echo Loc::getMessage('ADDRESS_SAVED'); ?></p>
                            </div>
                        </div>

                        <div class="bx-soa-section-content container-fluid" id="delivery-set"></div>

					</div>
					<!--	PICKUP BLOCK	-->
					<div id="bx-soa-pickup" data-visited="false" class="bx-soa-section" style="display:none">
						<div class="bx-soa-section-title-container">
							<h2 class="bx-soa-section-title col-sm-9">
								<span class="bx-soa-section-title-count"></span>
							</h2>
							<div class="col-xs-12 col-sm-3 text-right"><a href="" class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
						</div>
						<div class="bx-soa-section-content container-fluid"></div>
					</div>
					<!--	PAY SYSTEMS BLOCK	-->
					<div id="bx-soa-paysystem" data-visited="false" class="bx-soa-section bx-active">
						<div class="bx-soa-section-title-container">
							<h2 class="bx-soa-section-title col-sm-9">
								<span class="bx-soa-section-title-count"></span><?=$arParams['MESS_PAYMENT_BLOCK_NAME']?>
							</h2>
							<div class="col-xs-12 col-sm-3 text-right"><a href="" class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
						</div>
						<div class="bx-soa-section-content container-fluid"></div>
					</div>
				<? endif ?>
				<!--	BUYER PROPS BLOCK	-->
				<div id="bx-soa-properties" data-visited="false" class="bx-soa-section bx-active">
					<div class="bx-soa-section-title-container">
						<h2 class="bx-soa-section-title col-sm-9">
							<span class="bx-soa-section-title-count"></span><?=$arParams['MESS_BUYER_BLOCK_NAME']?>
						</h2>
						<div class="col-xs-12 col-sm-3 text-right"><a href="" class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
					</div>
					<div class="bx-soa-section-content container-fluid"></div>
				</div>

				<? if ($arParams['BASKET_POSITION'] === 'after'): ?>
					<!--	BASKET ITEMS BLOCK	-->
					<div id="bx-soa-basket" data-visited="false" class="bx-soa-section bx-active">
						<div class="bx-soa-section-title-container">
							<h2 class="bx-soa-section-title col-sm-9">
								<span class="bx-soa-section-title-count"></span><?=$arParams['MESS_BASKET_BLOCK_NAME']?>
							</h2>
							<div class="col-xs-12 col-sm-3 text-right"><a href="javascript:void(0)" class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
						</div>
						<div class="bx-soa-section-content container-fluid"></div>
					</div>
				<? endif ?>

				<!--	ORDER SAVE BLOCK	-->
				<div id="bx-soa-orderSave">
					<div class="checkbox">
						<?
						if ($arParams['USER_CONSENT'] === 'Y')
						{
							$APPLICATION->IncludeComponent(
								'bitrix:main.userconsent.request',
								'',
								array(
									'ID' => $arParams['USER_CONSENT_ID'],
									'IS_CHECKED' => $arParams['USER_CONSENT_IS_CHECKED'],
									'IS_LOADED' => $arParams['USER_CONSENT_IS_LOADED'],
									'AUTO_SAVE' => 'N',
									'SUBMIT_EVENT_NAME' => 'bx-soa-order-save',
									'REPLACE' => array(
										'button_caption' => isset($arParams['~MESS_ORDER']) ? $arParams['~MESS_ORDER'] : $arParams['MESS_ORDER'],
										'fields' => $arResult['USER_CONSENT_PROPERTY_DATA']
									)
								)
							);
						}
						?>
					</div>
					<a href="javascript:void(0)" style="margin: 10px 0" class="pull-right btn btn-default btn-lg hidden-xs" data-save-button="true">
						<?=$arParams['MESS_ORDER']?>
					</a>
				</div>

				<div style="display: none;">
					<div id='bx-soa-basket-hidden' class="bx-soa-section"></div>
					<div id='bx-soa-region-hidden' class="bx-soa-section"></div>
					<div id='bx-soa-paysystem-hidden' class="bx-soa-section"></div>
					<div id='bx-soa-delivery-hidden' class="bx-soa-section"></div>
					<div id='bx-soa-pickup-hidden' class="bx-soa-section"></div>
					<div id="bx-soa-properties-hidden" class="bx-soa-section"></div>
					<div id="bx-soa-auth-hidden" class="bx-soa-section">
						<div class="bx-soa-section-content container-fluid reg"></div>
					</div>
				</div>
			</div>

			<!--	SIDEBAR BLOCK	-->
			<div id="bx-soa-total" class="col-sm-3 bx-soa-sidebar">
				<div class="bx-soa-cart-total-ghost"></div>
				<div class="bx-soa-cart-total"></div>
			</div>
		</div>
	</form>

	<div id="bx-soa-saved-files" style="display:none"></div>
	<div id="bx-soa-soc-auth-services" style="display:none">
		<?
		$arServices = false;
		$arResult['ALLOW_SOCSERV_AUTHORIZATION'] = Main\Config\Option::get('main', 'allow_socserv_authorization', 'Y') != 'N' ? 'Y' : 'N';
		$arResult['FOR_INTRANET'] = false;

		if (Main\ModuleManager::isModuleInstalled('intranet') || Main\ModuleManager::isModuleInstalled('rest'))
			$arResult['FOR_INTRANET'] = true;

		if (Main\Loader::includeModule('socialservices') && $arResult['ALLOW_SOCSERV_AUTHORIZATION'] === 'Y')
		{
			$oAuthManager = new CSocServAuthManager();
			$arServices = $oAuthManager->GetActiveAuthServices(array(
				'BACKURL' => $this->arParams['~CURRENT_PAGE'],
				'FOR_INTRANET' => $arResult['FOR_INTRANET'],
			));

			if (!empty($arServices))
			{
				$APPLICATION->IncludeComponent(
					'bitrix:socserv.auth.form',
					'flat',
					array(
						'AUTH_SERVICES' => $arServices,
						'AUTH_URL' => $arParams['~CURRENT_PAGE'],
						'POST' => $arResult['POST'],
					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
			}
		}
		?>
	</div>

	<div style="display: none">
		<?
		// we need to have all styles for sale.location.selector.steps, but RestartBuffer() cuts off document head with styles in it
		$APPLICATION->IncludeComponent(
			'bitrix:sale.location.selector.steps',
			'.default',
			array(),
			false
		);
		$APPLICATION->IncludeComponent(
			'bitrix:sale.location.selector.search',
			'.default',
			array(),
			false
		);
		?>
	</div>
	<?
	$signer = new Main\Security\Sign\Signer;
	$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.order.ajax');
	$messages = Loc::loadLanguageFile(__FILE__);
	?>
	<script>
		BX.message(<?=CUtil::PhpToJSObject($messages)?>);
		BX.Sale.OrderAjaxComponent.init({
			result: <?=CUtil::PhpToJSObject($arResult['JS_DATA'])?>,
			locations: <?=CUtil::PhpToJSObject($arResult['LOCATIONS'])?>,
			params: <?=CUtil::PhpToJSObject($arParams)?>,
			signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
			siteID: '<?=CUtil::JSEscape($component->getSiteId())?>',
			ajaxUrl: '<?=CUtil::JSEscape($component->getPath().'/ajax.php')?>',
			templateFolder: '<?=CUtil::JSEscape($templateFolder)?>',
			propertyValidation: true,
			showWarnings: true,
			pickUpMap: {
				defaultMapPosition: {
					lat: 55.76,
					lon: 37.64,
					zoom: 7
				},
				secureGeoLocation: false,
				geoLocationMaxTime: 5000,
				minToShowNearestBlock: 3,
				nearestPickUpsToShow: 3
			},
			propertyMap: {
				defaultMapPosition: {
					lat: 55.76,
					lon: 37.64,
					zoom: 7
				}
			},
			orderBlockId: 'bx-soa-order',
			authBlockId: 'bx-soa-auth',
			basketBlockId: 'bx-soa-basket',
			regionBlockId: 'bx-soa-region',
			paySystemBlockId: 'bx-soa-paysystem',
			deliveryBlockId: 'bx-soa-delivery',
			pickUpBlockId: 'bx-soa-pickup',
			propsBlockId: 'bx-soa-properties',
			totalBlockId: 'bx-soa-total',
            gurumap: {
										            closeText: '<?=Loc::getMessage("DATEPICKER_CLOSE")?>',
										            prevText: '<?=Loc::getMessage("DATEPICKER_NEXT")?>',
										            nextText: '<?=Loc::getMessage("DATEPICKER_PREV")?>',
										            currentText: '<?=Loc::getMessage("DATEPICKER_TODAY")?>',
										            monthNames: ['<?=Loc::getMessage("DATEPICKER_JAN")?>', '<?=Loc::getMessage("DATEPICKER_FEB")?>', '<?=Loc::getMessage("DATEPICKER_MAR")?>', '<?=Loc::getMessage("DATEPICKER_APR")?>', '<?=Loc::getMessage("DATEPICKER_MAY")?>', '<?=Loc::getMessage("DATEPICKER_JUN")?>',
										            '<?=Loc::getMessage("DATEPICKER_JUL")?>', '<?=Loc::getMessage("DATEPICKER_AUG")?>', '<?=Loc::getMessage("DATEPICKER_SEP")?>', '<?=Loc::getMessage("DATEPICKER_OCT")?>', '<?=Loc::getMessage("DATEPICKER_NOV")?>', '<?=Loc::getMessage("DATEPICKER_DEC")?>'],
										            monthNamesShort: ['<?=Loc::getMessage("DATEPICKER_JAN")?>', '<?=Loc::getMessage("DATEPICKER_FEB")?>', '<?=Loc::getMessage("DATEPICKER_MAR")?>', '<?=Loc::getMessage("DATEPICKER_APR")?>', '<?=Loc::getMessage("DATEPICKER_MAY")?>', '<?=Loc::getMessage("DATEPICKER_JUN")?>',
										            '<?=Loc::getMessage("DATEPICKER_JUL")?>', '<?=Loc::getMessage("DATEPICKER_AUG")?>', '<?=Loc::getMessage("DATEPICKER_SEP")?>', '<?=Loc::getMessage("DATEPICKER_OCT")?>', '<?=Loc::getMessage("DATEPICKER_NOV")?>', '<?=Loc::getMessage("DATEPICKER_DEC")?>'],
										            dayNames: ['<?=Loc::getMessage("DATEPICKER_SUN")?>', '<?=Loc::getMessage("DATEPICKER_MON")?>', '<?=Loc::getMessage("DATEPICKER_TUE")?>', '<?=Loc::getMessage("DATEPICKER_WED")?>', '<?=Loc::getMessage("DATEPICKER_THU")?>', '<?=Loc::getMessage("DATEPICKER_FRI")?>', '<?=Loc::getMessage("DATEPICKER_SAT")?>'],
										            dayNamesShort: ['<?=Loc::getMessage("DATEPICKER_SSUN")?>', '<?=Loc::getMessage("DATEPICKER_SMON")?>', '<?=Loc::getMessage("DATEPICKER_STUE")?>', '<?=Loc::getMessage("DATEPICKER_SWED")?>', '<?=Loc::getMessage("DATEPICKER_STHU")?>', '<?=Loc::getMessage("DATEPICKER_SFRI")?>', '<?=Loc::getMessage("DATEPICKER_SSAT")?>'],
										            dayNamesMin: ['<?=Loc::getMessage("DATEPICKER_MSUN")?>', '<?=Loc::getMessage("DATEPICKER_MMON")?>', '<?=Loc::getMessage("DATEPICKER_MTUE")?>', '<?=Loc::getMessage("DATEPICKER_MWED")?>', '<?=Loc::getMessage("DATEPICKER_MTHU")?>', '<?=Loc::getMessage("DATEPICKER_MFRI")?>', '<?=Loc::getMessage("DATEPICKER_MSAT")?>'],
										            weekHeader: '<?=Loc::getMessage("DATEPICKER_WEE")?>',
										            dateFormat: 'dd.mm.yy',
										            firstDay: 1,
										            isRTL: false,
										            showMonthAfterYear: false,
										            yearSuffix: ''
										        },
		});
	</script>
	<script>
		<?
		// spike: for children of cities we place this prompt
		$city = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();
		?>
		BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
			'source' => $component->getPath().'/get.php',
			'cityTypeId' => intval($city['ID']),
			'messages' => array(
				'otherLocation' => '--- '.Loc::getMessage('SOA_OTHER_LOCATION'),
				'moreInfoLocation' => '--- '.Loc::getMessage('SOA_NOT_SELECTED_ALT'), // spike: for children of cities we place this prompt
				'notFoundPrompt' => '<div class="-bx-popup-special-prompt">'.Loc::getMessage('SOA_LOCATION_NOT_FOUND').'.<br />'.Loc::getMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
						'#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
						'#ANCHOR_END#' => '</a>'
					)).'</div>'
			)
		))?>);
	</script>
	<?
	if ($arParams['SHOW_PICKUP_MAP'] === 'Y' || $arParams['SHOW_MAP_IN_PROPS'] === 'Y')
	{
		if ($arParams['PICKUP_MAP_TYPE'] === 'yandex')
		{
			$this->addExternalJs($templateFolder.'/scripts/yandex_maps.js');
			$apiKey = htmlspecialcharsbx(Main\Config\Option::get('fileman', 'yandex_map_api_key', ''));
			?>
			<script src="<?=$scheme?>://api-maps.yandex.ru/2.1.50/?apikey=<?=$apiKey?>&load=package.full&lang=<?=$locale?>"></script>
			<script>
				(function bx_ymaps_waiter(){
					if (typeof ymaps !== 'undefined' && BX.Sale && BX.Sale.OrderAjaxComponent)
						ymaps.ready(BX.proxy(BX.Sale.OrderAjaxComponent.initMaps, BX.Sale.OrderAjaxComponent));
					else
						setTimeout(bx_ymaps_waiter, 100);
				})();
			</script>
			<?
		}

		if ($arParams['PICKUP_MAP_TYPE'] === 'google')
		{
			$this->addExternalJs($templateFolder.'/scripts/google_maps.js');
			$apiKey = htmlspecialcharsbx(Main\Config\Option::get('fileman', 'google_map_api_key', ''));
			?>
			<script async defer
				src="<?=$scheme?>://maps.googleapis.com/maps/api/js?key=<?=$apiKey?>&callback=bx_gmaps_waiter">
			</script>
			<script>
				function bx_gmaps_waiter()
				{
					if (BX.Sale && BX.Sale.OrderAjaxComponent)
						BX.Sale.OrderAjaxComponent.initMaps();
					else
						setTimeout(bx_gmaps_waiter, 100);
				}
			</script>
			<?
		}
	}

	if ($arParams['USE_YM_GOALS'] === 'Y')
	{
		?>
		<script>
			(function bx_counter_waiter(i){
				i = i || 0;
				if (i > 50)
					return;

				if (typeof window['yaCounter<?=$arParams['YM_GOALS_COUNTER']?>'] !== 'undefined')
					BX.Sale.OrderAjaxComponent.reachGoal('initialization');
				else
					setTimeout(function(){bx_counter_waiter(++i)}, 100);
			})();
		</script>
		<?
	}
}
