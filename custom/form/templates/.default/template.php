<?
/**
 * @var $APPLICATION
 * @var $templateFolder
 */

$asset = \Bitrix\Main\Page\Asset::getInstance();
$asset->addCss($templateFolder. '/css/bootstrap.min.css');
$asset->addJs($templateFolder. '/js/bootstrap.min.css');
$asset->addJs($templateFolder. '/js/jquery-3.4.1.min.js');
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <form id="form" data-component="custom:form/.default">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="name">First name</label>
                            <input class="form-control" type="text" placeholder="First name" id="name" data-component="custom:form/.default" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid name.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="phone">Phone</label>
                            <input class="form-control" type="tel" placeholder="Phone" id="phone" data-component="custom:form/.default" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid phone.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="email" placeholder="E-mail" id="email" data-component="custom:form/.default" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid e-mail.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="message">Message</label>
                            <textarea class="form-control" placeholder="Message" name="" rows="5" id="message" data-component="custom:form/.default" required></textarea>
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide a valid message.
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" id="button" data-component="custom:form/.default">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="application/javascript">
    `use strict`;

    $(`#button[data-component='custom:form/.default']`).click(e => {
        e.preventDefault();
        let status = true;
        $(`#form[data-component='custom:form/.default']`).find(`*[required]`).each((index, el) => {
            if ($(el).val() === ``) {
                $(el).removeClass(`is-valid`);
                $(el).addClass(`is-invalid`);
                status = false
            } else {
                $(el).addClass(`is-valid`);
                $(el).removeClass(`is-invalid`);
            }
        });
        if (status) {
            $.ajax({
                method: `post`,
                url: `<?=$APPLICATION->GetCurDir()?>`,
                data: {
                    COMPONENT: `custom:form`,
                    NAME: $(`#name[data-component='custom:form/.default']`).val(),
                    EMAIL: $(`#email[data-component='custom:form/.default']`).val(),
                    PHONE: $(`#phone[data-component='custom:form/.default']`).val(),
                    MESSAGE: $(`#message[data-component='custom:form/.default']`).val()
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