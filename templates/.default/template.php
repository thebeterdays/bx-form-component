<?
/**
 * @var $APPLICATION
 * @var $templateFolder
 * @var $arParams
 * @var $arResult
 */
?>

<script src="<?= $templateFolder ?>/js/jquery-3.4.1.min.js"></script>
<script src="<?= $templateFolder ?>/js/jquery-ui.js"></script>
<script src="<?= $templateFolder ?>/js/jquery.paroller.min.js"></script>
<script src="<?= $templateFolder ?>/js/bootstrap.min.js"></script>
<script src="<?= $templateFolder ?>/js/datepicker/bootstrap-datepicker.min.js"></script>

<link rel="stylesheet" href="<?= $templateFolder ?>/css/jquery-ui.css">
<link rel="stylesheet" href="<?= $templateFolder ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= $templateFolder ?>/css/datepicker/bootstrap-datepicker.standalone.min.css">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <form id="form_<?= $arParams['TOKEN'] ?>" enctype="multipart/form-data" type="post">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="name">First name</label>
                            <input class="form-control" type="text" name="name" placeholder="First name"
                                   id="name" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid name.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="phone">Phone</label>
                            <input class="form-control" type="tel" placeholder="Phone"
                                   id="phone" name="phone" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid phone.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="email" placeholder="E-mail"
                                   id="email" name="email" required>
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
                            <textarea class="form-control" placeholder="Message" name="message" rows="5"
                                      id="message" required></textarea>
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide a valid message.
                        </div>
                    </div>
                    <div class="col-md-12 mb-3 custom-file">
                        <input type="file" class="custom-file-input" id="file" name="file" required>
                        <label class="custom-file-label" for="file">Choose file...</label>
                    </div>
                    <div class="form-row align-items-center">
                        <div class="col-md-4 mb-3 date">
                            <label class="sr-only" for="date">Date</label>
                            <input type="text" class="form-control" placeholder="Date"
                                   id="date" name="date" required>
                            <span class="input-group-addon"></span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="sr-only" for="select">Preference</label>
                            <select class="custom-select" id="select" name="select" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                       id="checkbox" name="checkbox" required>
                                <label class="custom-control-label"
                                       for="checkbox">Check</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary" name="button">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="application/javascript">
    `use strict`

    $(() => {
        $(`#form_<?=$arParams['TOKEN']?> *[name="date"]`).datepicker({
            format: `dd.mm.yyyy`,
        })

        $(`#form_<?=$arParams['TOKEN']?> *[name="file"]`).change(e => {
            $(e.currentTarget).next(`label`).html(e.currentTarget.files[0].name)
        })

        $(`#form_<?=$arParams['TOKEN']?>`).hover(() => {
            if (typeof recaptcha === "undefined") {
                const rescript = document.createElement('script');
                rescript.src = `https://www.google.com/recaptcha/api.js?render=<?= $arParams['RECAPTCHA_PUBLIC_KEY'] ?>`
                document.body.append(rescript)
            }
        })

        $(`#form_<?=$arParams['TOKEN']?> button`).click(() => {
            let validate = true

            $(`#form_<?=$arParams['TOKEN']?> *[required]`).each((index, el) => {
                if ($(el).val() === '') {
                    $(el).css('border', '1px solid red')
                    validate = false
                } else if ($(el).is(':not(:checked)') && $(el).is(':checkbox')) {
                    $(el).parent().css('border', '1px solid red')
                    validate = false
                } else {
                    $(el).css('border', 'unset')
                }
            })

            if (validate) {
                grecaptcha.ready(async () => {
                    const retoken = await grecaptcha.execute('<?=$arParams['RECAPTCHA_PUBLIC_KEY']?>', {action: 'feedback'})

                    let data = new FormData

                    data.append(`RECAPTCHA`, retoken)
                    data.append(`TOKEN`, `<?=$arParams['TOKEN']?>`)
                    data.append(`DETAIL_URL`, `<?=$APPLICATION->GetCurDir()?>`)
                    data.append(`NAME`, $(`#form_<?=$arParams['TOKEN']?> *[name="name"]`).val())
                    data.append(`DATE`, $(`#form_<?=$arParams['TOKEN']?> *[name="date"]`).val())
                    data.append(`CHECKBOX`, $(`#form_<?=$arParams['TOKEN']?> *[name="checkbox"]`).val())
                    data.append(`SELECT`, $(`#form_<?=$arParams['TOKEN']?> *[name="select"]`).val())
                    data.append(`PHONE`, $(`#form_<?=$arParams['TOKEN']?> *[name="phone"]`).val())
                    data.append(`EMAIL`, $(`#form_<?=$arParams['TOKEN']?> *[name="email"]`).val())
                    data.append(`MESSAGE`, $(`#form_<?=$arParams['TOKEN']?> *[name="message"]`).val())
                    data.append(`DOCUMENT`, $(`#form_<?=$arParams['TOKEN']?> *[name="file"]`)[0])

                    $.ajax({
                        method: `post`,
                        url: `<?=$APPLICATION->GetCurDir()?>`,
                        data: data,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            data = JSON.parse(data)
                            if (data.status === true) {
                                alert(data.message)
                                location.reload()
                            } else {
                                alert(data.message)
                            }
                        }
                    })
                })
            }
        })
    })
</script>