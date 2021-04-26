<?
/**
 * @var $APPLICATION
 * @var $templateFolder
 * @var $arParams
 * @var $arResult
 */
$this->addExternalCss('/local/static/bundle/consult.css');
?>
    <section class="consult">
        <div class="consult-wrapper">
            <div class="consult-wrapper__row">
                <div class="inner-wrapper">
                    <div class="partners">
                        <div class="partner-item" style="background: url('/local/static/assets/pic/partners/logo_valvoline.svg') no-repeat center;"></div>
                        <div class="partner-item" style="background: url('/local/static/assets/pic/partners/logo_versatile.svg') no-repeat center;"></div>
                        <div class="partner-item" style="background: url('/local/static/assets/pic/partners/logo_spicer.svg') no-repeat center;"></div>
                    </div>
                    <div class="consult-wrapper__form">
                        <div class="form-title">
                            <strong>Помощь консультанта <br></strong> в подборе запчастей
                        </div>
                        <div class="form-success form-success--default">
                            <img src="/local/static/assets/img/checked.svg" alt="">Вы успешно отправили заявку!
                        </div>
                        <form id="form_<?= $arParams['TOKEN'] ?>">
                            <div class="form-row">
                                <input type="text"
                                       name="name"
                                       class="name"
                                       placeholder="Ваше имя"
                                       required
                                       data-validation-error-msg-required="Поле, обязательно к заполнению"
                                       data-validation="required">

                                <input type="tel"
                                       name="phone"
                                       class="phone"
                                       placeholder="Телефон"
                                       required
                                       data-validation-error-msg-required="Поле, обязательно к заполнению"
                                       data-validation="required">
                            </div>
                            <div class="form-row">
                                <input type="text"
                                       name="company"
                                       class="company"
                                       placeholder="Название компании"
                                       required
                                       data-validation-error-msg-required="Поле, обязательно к заполнению"
                                       data-validation="required">
                            </div>
                            <div class="form-row">
                            <textarea type="text"
                                      name="question"
                                      class="textarea"
                                      placeholder="Интересующий вас вопрос"
                                      required
                                      data-validation-error-msg-required="Поле, обязательно к заполнению"
                                      data-validation="required"></textarea>
                            </div>
                            <div class="form-row">
                                <select name="region" required style="width: 100%;
    border: none;
    padding: 16px 20px;
    color: #26293b;
    font: 500 14px/100% Montserrat;
">
                                    <option style="display: none;" value=''>Выберите регион</option>
                                    <? foreach ($GLOBALS['regions'] as $arRegion): ?>
                                        <option value='<?= $arRegion['0'] ?>'><?= $arRegion['0'] ?></option>
                                    <?endforeach;
                                    unset($GLOBALS['regions']) ?>
                                </select>
                            </div>
                            <div class="form-row">
                            <span>
                                Нажимая кнопку «Oтправить», вы даете согласие <a href="#" target="_blank"><strong>на обработку персональных данных</strong></a>
                            </span>
                                <button type="button" class="red-btn">Отправить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
if ($arParams['RECAPTCHA_ENABLED'] === 'Y') {
    include('script.recaptcha.php');
} else {
    include('script.php');
}
