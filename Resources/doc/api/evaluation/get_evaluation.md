TmsFaqBundle API: [GET] Evaluation
==================================

Retrieve one evaluation


## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /faq/evaluations/{id}
| **Formats** | json, xml
| **Secured** | false

## HTTP Request parameters
No request parameters

## HTTP Response codes
| Code | Description
|------|------------
| 200  | Ok
| 404  | Not found (wrong id)
| 500  | Server error

## HTTP Response content examples
### json
```json
{
    "metadata": {
        "type": "Tms\\Bundle\\FaqBundle\\Entity\\Evaluation",
        "serializerContextGroup": "tms_rest.item"
    },
    "data": {
        "id": 10,
        "value": 1,
        "createdAt": "2014-07-30T03:12:32+0200"
    },
    "links": {
        "self": {
            "rel": "self",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/evaluations/10"
        },
        "embeddeds": {
            "question": {
                "rel": "embedded",
                "href": "http://operation-manager.tessi/app_dev.php/api/faq/evaluations/10/question"
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
            <![CDATA[Tms\Bundle\FaqBundle\Entity\Evaluation]]>
        </entry>
        <entry>
            <![CDATA[tms_rest.item]]>
        </entry>
    </entry>
    <entry>
        <id>10</id>
        <value>1</value>
        <createdAt>
            <![CDATA[2014-07-30T03:12:32+0200]]>
        </createdAt>
    </entry>
    <entry>
        <entry>
            <entry>
                <![CDATA[self]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/evaluations/10.xml]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <entry>
                    <![CDATA[embedded]]>
                </entry>
                <entry>
                    <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/evaluations/10/question.xml]]>
                </entry>
            </entry>
        </entry>
    </entry>
    <entry/>
</result>
```