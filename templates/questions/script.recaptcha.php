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
        const formContainer = $('.questionform-wrapper__form')
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
                    $(el).css('border', '3px solid #1e2335')
                    validate = false
                } else if ($(el).is(':not(:checked)') && $(el).is(':checkbox')) {
                    $(el).parent().css('border', '3px solid #1e2335')
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
                    data.append(`NAME`, $(`#form_<?=$arParams['TOKEN']?> *[name="name"]`).val())
                    //data.append(`REGION`, $(`#form_<?//=$arParams['TOKEN']?>// *[name="s-region"]`).val())
                    data.append(`PHONE`, $(`#form_<?=$arParams['TOKEN']?> *[name="phone"]`).val())
                    data.append(`COMPANY`, $(`#form_<?=$arParams['TOKEN']?> *[name="company"]`).val())
                    data.append(`PRICE`, $(`#form_<?=$arParams['TOKEN']?> *[name="availability_and_price"]`)[0].checked)
                    data.append(`DELIVERY`, $(`#form_<?=$arParams['TOKEN']?> *[name="delivery"]`)[0].checked)
                    data.append(`MESSAGE`, $(`#form_<?=$arParams['TOKEN']?> *[name="question"]`).val())
                    $.ajax({
                        method: `post`,
                        url: `<?=$APPLICATION->GetCurDir()?>`,
                        data: data,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            data = JSON.parse(data)
                            if (data.status === true) {
                                formContainer.find('.form-block, .form-row').slideUp(200);
                                setTimeout(function() {
                                    formContainer.find('.form-success').fadeIn(300).css('display', 'flex');
                                }, 200)
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
