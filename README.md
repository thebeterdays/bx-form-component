# Bitrix form component

__Calling example:__
```php
$APPLICATION->IncludeComponent(
	"custom:bitrix-custom-form",
	"",
	[
        'IBLOCK_ID' => '1',
        'PROPS' => [
            'NAME', // type - string
            'EMAIL', // type - string
            'PHONE', // type - string
            'ABOUT,TEXT' // type - html/text
        ]
    ]
);
```
