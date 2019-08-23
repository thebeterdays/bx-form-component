# Bitrix custom form component

__Component calling example for default template:__
```php
$APPLICATION->IncludeComponent(
	"custom:form",
	"",
	[
        'IBLOCK_ID' => '1',
        'MAIL_EVENT' => 'FORM_SENDED',
        'TOKEN' => 'form001',
        'PROPS' => [
            'NAME', // type - string
            'EMAIL', // type - string
            'PHONE', // type - string
            'MESSAGE,TEXT', // type - html/text
        ],
    ]
);
```
