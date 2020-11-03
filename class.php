<?

use \Bitrix\Main\Application,
    \Bitrix\Main\Loader,
    \Bitrix\Main\Mail\Event;

/**
 * Class Form
 */
class CustomFormComponent extends CBitrixComponent
{

    public function executeComponent()
    {

        $request = Application::getInstance()->getContext()->getRequest();

        if ($request->getPost("TOKEN") == $this->arParams["TOKEN"]) {

            $GLOBALS["APPLICATION"]->RestartBuffer();

            $props = array_merge($request->getPostList()->toArray(), $request->getFileList()->toArray());
            $available_props = $this->arParams["PROPS"];
            $iblock_id = $this->arParams["IBLOCK_ID"];
            $iblock_el_id = $this->save($iblock_id, $props, $available_props);

            $db_list = CIBlockElement::GetList(
                array("SORT" => "ASC"),
                array(
                    "IBLOCK_ID" => $iblock_id,
                    "ID" => $iblock_el_id
                )
            );

            if ($db_el = $db_list->GetNextElement()) {
                $iblock_el_props = $db_el->GetProperties();

                $event_params = array(
                    "EVENT_NAME" => $this->arParams["MAIL_EVENT"],
                    "LID" => SITE_ID,
                    "C_FIELDS" => array(
                        "EMAIL_TO" => $this->arParams["EMAIL_TO"],
                        "EMAIL_FROM" => $this->arParams["EMAIL_FROM"]
                    )
                );

                foreach ($iblock_el_props as $code => $prop) {
                    if ($prop["PROPERTY_TYPE"] === "F") {
                        $tag = CFile::GetPath($prop["VALUE"]);
                        $event_params["C_FIELDS"][$code] = $tag;
                        continue;
                    }

                    $event_params["C_FIELDS"][$code] = $prop["VALUE"];
                }

                Event::send($event_params);
            }

            echo json_encode(["status" => true]);
            exit();
        }

        $this->includeComponentTemplate();
    }

    private function save($iblock_id, $props, $available_props)
    {

        if (!Loader::includeModule("iblock")) die();

        $el = new CIBlockElement;
        $fields = [
            "NAME" => !empty($this->arParams["FORM_NAME"]) ? $this->arParams["FORM_NAME"] : "Форма",
            "IBLOCK_ID" => $iblock_id,
            "PROPERTY_VALUES" => []
        ];
        if (isset($this->arParams["ACTIVE"])) {
            $fields["ACTIVE"] = $this->arParams["ACTIVE"];
        }
        foreach ($props as $key => $prop) {
            if (in_array($key, $available_props)) {
                $fields["PROPERTY_VALUES"][$key]["VALUE"] = $prop;
            } else if (in_array("$key,TEXT", $available_props)) {
                $fields["PROPERTY_VALUES"][$key]["VALUE"] = [
                    "TYPE" => "TEXT",
                    "TEXT" => $prop
                ];
            } else if (in_array("$key,HTML", $available_props)) {
                $fields["PROPERTY_VALUES"][$key]["VALUE"] = [
                    "TYPE" => "HTML",
                    "TEXT" => $prop
                ];
            } else if (in_array("$key,FILE", $available_props)) {
                $fields["PROPERTY_VALUES"][$key] = $_FILES[$key];
            }
        }
        $id = $el->Add($fields);

        return $id;
    }
}
