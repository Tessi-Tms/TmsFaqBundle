TmsFaqBundle API: [GET] Faq
===========================

Retrieve one Faq


## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /faqs/{id}.{_format}
| **Formats** | json|xml
| **Secured** | false

## HTTP Request parameters
No request parameters

## HTTP Response codes
| Code | Description
|------|------------
| 200  | Ok
| 404  | Not found (wrong id)
| 500  | Server error

### json
```json
{
    "metadata": {
        "type": "Tms\\Bundle\\FaqBundle\\Entity\\Faq",
        "serializerContextGroup": "tms_rest.item"
    },
    "data": {
        "id": 22,
        "title": "FAQ SFR",
        "enabled": true
    },
    "links": {
        "self": {
            "rel": "self",
            "href": "http://operation-manager.tessi/app_dev.php/api/faqs/22"
        },
        "embeddeds": {
            "categories": {
                "rel": "embedded",
                "href": "http://operation-manager.tessi/app_dev.php/api/faqs/22/questioncategories"
            },
            "questions": {
                "rel": "embedded",
                "href": "http://operation-manager.tessi/app_dev.php/api/faqs/22/questions"
            }
        }
    },
    "actions": []
}
```

### xml
```xml
<?xml version="1.0" encoding="UTF-8"?>
<result>
    <entry>
        <entry>
            <![CDATA[Tms\Bundle\FaqBundle\Entity\Faq]]>
        </entry>
        <entry>
            <![CDATA[tms_rest.item]]>
        </entry>
    </entry>
    <entry>
        <id>22</id>
        <title>
            <![CDATA[FAQ SFR]]>
        </title>
        <enabled>true</enabled>
    </entry>
    <entry>
        <entry>
            <entry>
                <![CDATA[self]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs/22.xml]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <entry>
                    <![CDATA[embedded]]>
                </entry>
                <entry>
                    <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs/22/questioncategories.xml]]>
                </entry>
            </entry>
            <entry>
                <entry>
                    <![CDATA[embedded]]>
                </entry>
                <entry>
                    <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs/22/questions.xml]]>
                </entry>
            </entry>
        </entry>
    </entry>
    <entry/>
</result>
```