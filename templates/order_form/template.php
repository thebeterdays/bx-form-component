<?
/**
 * @var $APPLICATION
 * @var $templateFolder
 * @var $arParams
 * @var $arResult
 */
$this->addExternalCss('/local/static/bundle/modalorder.css');
$regionsQuery = CIBlockElement::getList(Array("NAME" => 'ASC'), Array("IBLOCK_ID" => 20), false, Array(), Array("IBLOCK_ID", "NAME", "PROPERTY_MANAGER_MAIL"));
?>
    <div class="modal-order" id="modal-order" tabindex="-1" role="dialog" style="margin-top: unset;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Оформление заказа</div>
                    <!--                <a href="--><?//=SITE_DIR?><!--" class="close" data-dismiss="modal" aria-label="Close"></a>-->
                </div>
                <form id="form-order">
                    <div class="modal-body">
                        <div class="form-success form-success--modal">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 426.667 426.667" style="enable-background:new 0 0 426.667 426.667;" xml:space="preserve">
                                <path style="fill:#1e2335;" d="M213.333,0C95.518,0,0,95.514,0,213.333s95.518,213.333,213.333,213.333
                                c117.828,0,213.333-95.514,213.333-213.333S331.157,0,213.333,0z M174.199,322.918l-93.935-93.931l31.309-31.309l62.626,62.622
                                l140.894-140.898l31.309,31.309L174.199,322.918z"/>
                            </svg>
                            Вы успешно отправили заявку!
                        </div>
                        <div class="modal-order-form">
                            <div class="form-leftside">
                                <input type="text"
                                       name="name"
                                       class="modal-order-input order-name"
                                       placeholder="Ваше имя"
                                       required
                                       data-validation-error-msg-required="Поле, обязательно к заполнению"
                                       data-validation="required">

                                <div class="input-row">
                                    <input type="tel"
                                           name="phone"
                                           class="modal-order-input order-phone"
                                           placeholder="Телефон"
                                           required
                                           data-validation-error-msg-required="Поле, обязательно к заполнению"
                                           data-validation="required">

                                    <input type="email"
                                           name="email"
                                           class="modal-order-input order-email"
                                           placeholder="E-mail"
                                           required
                                           data-validation-error-msg-required="Поле, обязательно к заполнению"
                                           data-validation="required">
                                </div>
                                <select
                                        name="region"
                                        class="modal-order-input order-region"
                                        required
                                        data-validation-error-msg-required="Поле, обязательно к заполнению"
                                        data-validation="required">
                                    <option style="display: none;">Выберите регион</option>
                                    <?while ($region = $regionsQuery->fetch()):?>
                                        <option value="<?=$region['PROPERTY_MANAGER_MAIL_VALUE']?>"><?=$region['NAME']?></option>
                                    <?endwhile?>
                                </select>
                            </div>
                            <div class="form-rightside">
                                <textarea name="question"
                                          class="modal-order-textarea"
                                          id=""
                                          cols="30"
                                          rows="10"
                                          placeholder="Комментарий к заказу"
                                          required
                                          data-validation-error-msg-required="Поле, обязательно к заполнению">
                                </textarea>
                            </div>
                        </div>
                        <div class="order-composition">
                            <div class="comp-title">Состав вашего заказа</div>
                            <div class="comp-inner"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="success">Ваша заявка будет обработана в ближайшее время, и наш сотрудник свяжется с вами для уточнения деталей</div>
                        <div class="footer-row">
                            <div class="modal-agreement">Нажимая кнопку «Oтправить», вы даете согласие на <a href="#" target="_blank"><strong>обработку персональных данных</strong></a></div>
                            <button type="button" class="btn-submit--order" onclick="ym(55774312, 'reachGoal', 'zayavka'); return true;">Отправить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
if ($arParams['RECAPTCHA_ENABLED'] === 'Y') {
    include('script.recaptcha.php');
} else {
    include('script.php');
}
