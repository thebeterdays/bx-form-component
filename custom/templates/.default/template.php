<?
/**
 * @var $APPLICATION
 */
?>

<section class="block-padd">
    <div class="container">
        <div class="pagewside-content">
            <div class="text-content">
                <div class="h4">Наши требования к дилерам:</div>
                <ul>
                    <li>Наличие офиса, выставочной или торговой площади, торговой площадки в&nbsp;интернете и&nbsp;складских помещений</li>
                    <li>Проведение согласованной с «Мебельной Фабрикой Краснодар» рекламной и&nbsp;ценовой политики;</li>
                    <li>Оказание услуг по гарантийному и&nbsp;послепродажному обслуживанию и&nbsp;ремонту продукции «Мебельной Фабрики Краснодар»</li>
                </ul>
            </div>
            <div class="pt-4 pt-md-5">
                <div class="text-content">
                    <div class="h4">Оставьте заявку</div>
                    <p>Дилером может быть любое юридическое лицо любой формы собственности, осуществляющее свою деятельность согласно законодательства РФ и приобретающее мебель для последующей перепродажи.</p>
                </div>
                <div class="form pt-4 pt-md-5">
                    <form action="#" id="form-1" data-component="custom:form/dealer">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Ваше имя" id="name" data-component="custom:form/dealer" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control phone" type="tel" placeholder="Ваш телефон" id="phone" data-component="custom:form/dealer" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="email" placeholder="Ваш E-mail" id="email" data-component="custom:form/dealer" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Расскажите о вашей компании" name="" rows="9" id="about" data-component="custom:form/dealer" required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-sm mb-2 mb-sm-0">
                                        <label class="ch-check">
                                            <input type="checkbox" checked="checked" disabled>
                                            <span><small>Нажимая кнопку отправить вы соглашаетесь на <a id="personal-data" href="#personal-data">обработку персональных данных</a></small></span>
                                        </label>
                                    </div>
                                    <div class="col-12 col-sm-auto text-right">
                                        <button class="mbtn mbtn-brddark warrow-right" id="button-1" data-component="custom:form/dealer"><span>Отправить</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="application/javascript">
    `use strict`;
    
    $(`#button-1[data-component='custom:form/dealer']`).click(e => {
        e.preventDefault();
        let status = true;
        $(`#form-1[data-component='custom:form/dealer']`).find(`input[required]`).each((index, el) => {
            if ($(el).val() === ``) {
                $(el).css(`border-color`, `red`);
                status = false
            } else {
                $(el).css(`border-color`, `#666`);
            }
        });
        $(`#form-1[data-component='custom:form/dealer']`).find(`textarea[required]`).each((index, el) => {
            if ($(el).val() === ``) {
                $(el).css(`border-color`, `red`);
                status = false
            } else {
                $(el).css(`border-color`, `#666`);
            }
        });
        if (status) {
            $.ajax({
                method: `post`,
                url: `<?=$APPLICATION->GetCurDir()?>`,
                data: {
                    NAME: $(`#name[data-component='custom:form/dealer']`).val(),
                    EMAIL: $(`#email[data-component='custom:form/dealer']`).val(),
                    PHONE: $(`#phone[data-component='custom:form/dealer']`).val(),
                    ABOUT: $(`#about[data-component='custom:form/dealer']`).val()
                },
                success: (data) => {
                    data = JSON.parse(data);
                    if (data.status == true) {
                        alert(`Ваша заявка отправлена!`);
                        location.reload();
                    }
                }
            });
        }
    });
</script>