<?
/**
 * @var $APPLICATION
 * @var $templateFolder
 * @var $arParams
 * @var $arResult
 */
?>
    <div class="full-width s-form-wrapper" id="s-form">
        <div class="s-form-container">
            <div class="s-form__title">Закажите наши услуги</div>
            <div class="s-form__text">Внесите свои контактные данные и выберите вид услуг, мы свяжемся с вами в
                ближайшее время
            </div>
            <div class="s-form" id="form_<?= $arParams['TOKEN'] ?>">
                <input type="text" name="s-name" placeholder="Имя" required/>
                <input type="text" name="s-phone" placeholder="Телефон" required/>
                <div class="select-container">
                    <select name="s-region" required>
                        <option style="display: none;" value=''>Выберите регион</option>
                        <? foreach ($GLOBALS['regions'] as $arRegion): ?>
                            <option value='<?= $arRegion['0'] ?>'><?= $arRegion['0'] ?></option>
                        <?endforeach;
                        unset($GLOBALS['regions']) ?>
                    </select>
                    <input type="hidden" name="s-operator"/>
                </div>
                <div class="select-container">
                    <select name="s-service">
                        <? $servicesQuery = CIBlockElement::GetList(array("SORT" => "ASC", "ID" => "ASC"), array("IBLOCK_ID" => 22, "ACTIVE" => "Y"), array("IBLOCK_ID", "ID", "NAME", "ACTIVE", "CODE"));
                        while ($serviceItem = $servicesQuery->GetNextElement()):
                            $service = $serviceItem->GetFields(); ?>
                            <option <? echo($service['CODE'] == $code ? 'selected' : '') ?>><?= $service['NAME'] ?></option>
                        <?endwhile ?>
                    </select>
                </div>
                <button type="submit">Заказать</button>
            </div>


            <div class="s_form__success">Спасибо! Данные успешно отправлены.</div>
            <div class="s-form__policy">Нажимая на кнопку, вы даете согласие на обработку персональных данных и
                соглашаетесь c политикой конфиденциальности
            </div>
        </div>
        <div class="s-form-background"></div>
        <div class="s-form-background__filter"></div>
    </div>

<?php
if ($arParams['RECAPTCHA_ENABLED'] === 'Y') {
    include('script.recaptcha.php');
} else {
    include('script.php');
}
