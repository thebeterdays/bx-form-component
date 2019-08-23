<?

use \Bitrix\Main\Application,
	\Bitrix\Main\Loader,
	\Bitrix\Main\Mail;

/**
 * Class Form
 */
class Form extends CBitrixComponent {
	
	public function executeComponent() {
		
		$request = Application::getInstance()->getContext()->getRequest();
		
		if ($request->getPost('TOKEN') == $this->arParams['TOKEN']) {
			$GLOBALS['APPLICATION']->RestartBuffer();
			
			$props = $request->getPostList();
			$available_props = $this->arParams['PROPS'];
			$iblock_id = $this->arParams['IBLOCK_ID'];
			$this->save($iblock_id, $props, $available_props);
			
			$mail_send_result = Mail\Event::send(
				array(
					'EVENT_NAME' => $this->arParams['MAIL_EVENT'],
					'LID' => SITE_ID,
					'C_FIELDS' => $props->toArray()
				)
			);
			
			echo json_encode(['status' => true, 'mail_send_result' => $mail_send_result]);
			
			exit();
		}
		
		$this->includeComponentTemplate();
	}

	private function save($iblock_id, $props, $available_props) {
		
		if (!Loader::includeModule("iblock")) die();
		
		$el = new CIBlockElement;
		$fields = [
			'NAME' => 'Форма',
			'IBLOCK_ID' => $iblock_id,
			'PROPERTY_VALUES' => []
		];
		foreach ($props as $key => $prop) {
			if (in_array($key, $available_props)) {
				$fields['PROPERTY_VALUES'][$key]['VALUE'] = $prop;
			} else if (in_array("$key,TEXT", $available_props)) {
				$fields['PROPERTY_VALUES'][$key]['VALUE'] = [
					'TYPE' => 'TEXT',
					'TEXT' => $prop
				];
			} else if (in_array("$key,HTML", $available_props)) {
				$fields['PROPERTY_VALUES'][$key]['VALUE'] = [
					'TYPE' => 'HTML',
					'TEXT' => $prop
				];
			}
		}
		$id = $el->Add($fields);
		
		return $id;
	}
}