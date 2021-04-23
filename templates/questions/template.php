<?
/**
 * @var $APPLICATION
 * @var $templateFolder
 * @var $arParams
 * @var $arResult
 */

if (!\defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
$this->addExternalCss('/local/static/bundle/questionform.css');
if ($APPLICATION->GetCurPage() != '/basket/'):
    ?>
    <section class="questionform">
        <div class="questionform-wrapper">
            <div class="questionform-wrapper__leftblock">
                <div class="title">
                    Остались <br><strong>вопросы?</strong>
                </div>
                <div class="second-title">
                    Оставьте номер телефона <br>
                    и мы свяжемся с вами.
                </div>
            </div>
            <div class="questionform-wrapper__form" id="form_<?= $arParams['TOKEN'] ?>">
                <form  id="footer-form">
                    <div class="form-success form-success--default">
                        <img src="/local/static/assets/img/checked.svg" alt="">Вы успешно отправили заявку!
                    </div>
                    <div class="form-block">
                        <div class="form-first">
                            <input type="text"
                                   name="name"
                                   placeholder="Ваше имя"
                                   class="name"
                                   required
                                   data-validation-error-msg-required="Поле, обязательно к заполнению"
                                   data-validation="required">

                            <input type="text"
                                   placeholder="Телефон"
                                   name="phone"
                                   class="phone"
                                   required
                                   data-validation-error-msg-required="Поле, обязательно к заполнению"
                                   data-validation="required">

                            <input type="text"
                                   name="company"
                                   placeholder="Компания"
                                   class="company-lead"
                                   required
                                   data-validation-error-msg-required="Поле, обязательно к заполнению"
                                   data-validation="required">



                        </div>
                        <div class="form-second">
                            <div class="form-second__inner-wrapper">
                                <label for="availability_and_price">
                                    <!--<input type="checkbox" name="availability_and_price" class="js-price">-->
                                    <input type="checkbox" name="availability_and_price" >
                                    Узнать наличие и цену
                                </label>
                                <label for="delivery">
                                    <!--<input type="checkbox" name="delivery" class="js-delivery">-->
                                    <input type="checkbox" name="delivery" >
                                    Рассчитать доставку
                                </label>
                            </div>

                            <textarea name="question"
                                      id=""
                                      class="textarea js-textarea"
                                      placeholder="Введите артикул или название запчасти и укажите город для доставки"
                                      required
                                      data-validation-error-msg-required="Поле, обязательно к заполнению"
                                      data-validation="required"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                            <span>
                                Нажимая кнопку «Oтправить», вы даете согласие на <a href="#" target="_blank"><strong>обработку персональных данных</strong></a>
                            </span>
                        <button class="red-btn red-btn--question">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?endif;
if ($arParams['RECAPTCHA_ENABLED'] === 'Y') {
    include('script.recaptcha.php');
} else {
    include('script.php');
}
