# Bitrix custom form component

__Component calling example for default template:__
```php
$APPLICATION->IncludeComponent(
    "custom:form",
    "",
    array(
        'IBLOCK_ID' => '1',
        'MAIL_EVENT' => 'FORM_SENDED',
        'TOKEN' => 'form001',
        'PROPS' => array(
            'NAME', // type - string
            'EMAIL', // type - string
            'PHONE', // type - string
            'MESSAGE,TEXT', // type - html/text
            'DOCUMENT,FILE' // type - file
        ),
    )
);
```
