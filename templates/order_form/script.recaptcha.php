<?php
/**
 * @global $APPLICATION
 * @global $arResult
 * @global $arParams
 */
?>

<script type="application/javascript">
    `use strict`
    $(() => {
        const formContainer = $('.modal-order')
        $.customPhoneMask( $(`#form_<?=$arParams['TOKEN']?> *[name="phone"]`))
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
                    $(el).css('outline', '3px solid #f12525')
                    validate = false
                } else if ($(el).is(':not(:checked)') && $(el).is(':checkbox')) {
                    $(el).parent().css('outline', '3px solid #f12525')
                    validate = false
                } else {
                    $(el).css('outline', 'unset')
                }
            })

            if (validate) {
                grecaptcha.ready(async () => {
                    const retoken = await grecaptcha.execute('<?=$arParams['RECAPTCHA_PUBLIC_KEY']?>', {action: 'feedback'})
                    let data = new FormData
                    data.append(`RECAPTCHA`, retoken)
                    data.append(`TOKEN`, `<?=$arParams['TOKEN']?>`)
                    data.append(`NAME`, $(`#form_<?=$arParams['TOKEN']?> *[name="name"]`).val())
                    data.append(`REGION`, $(`#form_<?=$arParams['TOKEN']?> *[name="region"]`).val())
                    data.append(`PHONE`, $(`#form_<?=$arParams['TOKEN']?> *[name="phone"]`).val())
                    data.append(`EMAIL`, $(`#form_<?=$arParams['TOKEN']?> *[name="email"]`).val())
                    data.append(`MESSAGE`, $(`#form_<?=$arParams['TOKEN']?> *[name="question"]`).val())
                    data.append(`ORDER`, $(`#form_<?=$arParams['TOKEN']?> *[name="question"]`).val())
                    $.ajax({
                        method: `post`,
                        url: `<?=$APPLICATION->GetCurDir()?>`,
                        data: data,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            data = JSON.parse(data)
                            if (data.status === true) {
                                formContainer.find('.form-block, .form-row, .modal-footer, .modal-order-form, .order-composition').hide();
                                formContainer.find('.form-success').fadeIn(400);
                                $(this).parent('.modal-content').css('height', '33%');
                                $('.basket__side').html('Ваша корзина пуста.');
                                $('.basket__order').remove();
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
