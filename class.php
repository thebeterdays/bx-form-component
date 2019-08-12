<?

use \Bitrix\Main\Application,
	\Bitrix\Main\Loader;

/**
 * Class Form
 */
class Form extends CBitrixComponent {
	
	public function executeComponent() {
		
		$request = Application::getInstance()->getContext()->getRequest();
		
		if ($request->getPost('COMPONENT') == 'custom:form') {
			$GLOBALS['APPLICATION']->RestartBuffer();
			
			$props = $request->getPostList();
			$available_props = $this->arParams['PROPS'];
			$iblock_id = $this->arParams['IBLOCK_ID'];
			$this->save($iblock_id, $props, $available_props);
			
			echo json_encode(['status' => true]);
			
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