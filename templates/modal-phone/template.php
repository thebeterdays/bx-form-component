<?
/**
 * @var $APPLICATION
 * @var $templateFolder
 * @var $arParams
 * @var $arResult
 */
$this->addExternalCss('/local/static/bundle/modalphone.css');
?>

    <div class="modal modal-phone fade" id="modal-phone" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Заказать звонок</div>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close"></a>
                </div>
                <form id="form_<?= $arParams['TOKEN'] ?>">
                    <div class="modal-body">
                        <div class="form-success form-success--modal">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 426.667 426.667" style="enable-background:new 0 0 426.667 426.667;"
                                 xml:space="preserve">
<path style="fill:#1e2335;" d="M213.333,0C95.518,0,0,95.514,0,213.333s95.518,213.333,213.333,213.333
	c117.828,0,213.333-95.514,213.333-213.333S331.157,0,213.333,0z M174.199,322.918l-93.935-93.931l31.309-31.309l62.626,62.622
	l140.894-140.898l31.309,31.309L174.199,322.918z"/>
</svg>
                            Вы успешно отправили заявку!
                        </div>
                        <div class="form-row">
                            <input type="text"
                                   name="name"
                                   class="modal-phone-input name"
                                   placeholder="Ваше имя"
                                   required
                                   data-validation-error-msg-required="Поле, обязательно к заполнению"
                                   data-validation="required">

                            <input type="text"
                                   name="phone"
                                   class="modal-phone-input phone"
                                   placeholder="Телефон"
                                   required
                                   data-validation-error-msg-required="Поле, обязательно к заполнению"
                                   data-validation="required">
                        </div>
                        <div class="form-row">
                            <textarea name="question"
                                      class="modal-phone-textarea comment"
                                      id=""
                                      cols="30"
                                      rows="10"
                                      placeholder="Интересующий вас вопрос"
                                      required
                                      data-validation-error-msg-required="Поле, обязательно к заполнению"
                                      data-validation="required"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-agreement">Нажимая кнопку «Oтправить», вы даете согласие на обработку
                            персональных данных
                        </div>
                        <button type="button" class="red-btn" onclick="ym(55774312, 'reachGoal', 'recall'); return true;">Отправить
                        </button>
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
