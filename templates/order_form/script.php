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
                let data = new FormData
                data.append(`TOKEN`, `<?=$arParams['TOKEN']?>`)
                data.append(`NAME`, $(`#form_<?=$arParams['TOKEN']?> *[name="s-name"]`).val())
                data.append(`REGION`, $(`#form_<?=$arParams['TOKEN']?> *[name="s-region"]`).val())
                data.append(`PHONE`, $(`#form_<?=$arParams['TOKEN']?> *[name="s-phone"]`).val())
                data.append(`SERVICE`, $(`#form_<?=$arParams['TOKEN']?> *[name="s-service"]`).val())
                $.ajax({
                    method: `post`,
                    url: `<?=$APPLICATION->GetCurDir()?>`,
                    data: data,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        data = JSON.parse(data)
                        if (data.status === true) {
                            $('.s-form').hide();
                            $('.s_form__success').fadeIn(200);
                        } else {
                            alert(data.message)
                        }
                    }
                })
            }
        })
    })
</script>
