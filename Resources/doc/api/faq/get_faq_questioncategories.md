TmsFaqBundle API: [GET] Faq question categories
===============================================

Retrieve Faq question categories

## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /faqs/{id}/questioncategories.{_format}
| **Formats** | json, xml
| **Secured** | false

## HTTP Request parameters
| Name        | Optional | Default | Requirements | Description
|-------------|----------|---------|--------------|------------
| limit       | true     | 20      | \d+          | Pagination limit
| offset      | true     | 0       | \d+          | Pagination offet
| page        | true     |         |              |
| sort        | true     |         |              |

## HTTP Response codes
| Code | Description
|------|------------
| 200  | Ok
| 404  | Not found (wrong path)
| 500  | Server error

## HTTP Response content examples

### json
```json
{
    "metadata": {
        "type": "Tms\\Bundle\\FaqBundle\\Entity\\QuestionCategory",
        "serializerContextGroup": "tms_rest.collection",
        "page": 1,
        "pageCount": 2,
        "totalCount": 3,
        "limit": 2,
        "offset": 0,
        "id": "22"
    },
    "data": [
        {
            "metadata": {
                "type": "Tms\\Bundle\\FaqBundle\\Entity\\QuestionCategory",
                "serializerContextGroup": "tms_rest.item"
            },
            "data": {
                "id": 20,
                "name": "Votre participation",
                "slug": "votre-participation"
            },
            "links": {
                "self": {
                    "rel": "self",
                    "href": "http://operation-manager.tessi/app_dev.php/api/faq/questioncategories/20"
                }
            },
            "actions": []
        },
        {
            "metadata": {
                "type": "Tms\\Bundle\\FaqBundle\\Entity\\QuestionCategory",
                "serializerContextGroup": "tms_rest.item"
            },
            "data": {
                "id": 21,
                "name": "Modalités",
                "slug": "modalites"
            },
            "links": {
                "self": {
                    "rel": "self",
                    "href": "http://operation-manager.tessi/app_dev.php/api/faq/questioncategories/21"
                }
            },
            "actions": []
        }
    ],
    "links": {
        "self": {
            "rel": "self",
            "href": "http://operation-manager.tessi/app_dev.php/api/faqs/22/questioncategories?page=1&limit=2&offset=0"
        },
        "nextPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faqs/22/questioncategories?page=2&limit=2&offset=0"
        },
        "previousPage": {
            "rel": "nav",
            "href": ""
        },
        "firstPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faqs/22/questioncategories?page=1&limit=2&offset=0"
        },
        "lastPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faqs/22/questioncategories?page=2&limit=2&offset=0"
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
            <![CDATA[Tms\Bundle\FaqBundle\Entity\QuestionCategory]]>
        </entry>
        <entry>
            <![CDATA[tms_rest.collection]]>
        </entry>
        <entry>1</entry>
        <entry>2</entry>
        <entry>3</entry>
        <entry>2</entry>
        <entry>0</entry>
        <entry>
            <![CDATA[22]]>
        </entry>
    </entry>
    <entry>
        <entry>
            <entry>
                <entry>
                    <![CDATA[Tms\Bundle\FaqBundle\Entity\QuestionCategory]]>
                </entry>
                <entry>
                    <![CDATA[tms_rest.item]]>
                </entry>
            </entry>
            <entry>
                <id>20</id>
                <name>
                    <![CDATA[Votre participation]]>
                </name>
                <slug>
                    <![CDATA[votre-participation]]>
                </slug>
            </entry>
            <entry>
                <entry>
                    <entry>
                        <![CDATA[self]]>
                    </entry>
                    <entry>
                        <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questioncategories/20.xml]]>
                    </entry>
                </entry>
            </entry>
            <entry/></entry>
        <entry>
            <entry>
                <entry>
                    <![CDATA[Tms\Bundle\FaqBundle\Entity\QuestionCategory]]>
                </entry>
                <entry>
                    <![CDATA[tms_rest.item]]>
                </entry>
            </entry>
            <entry>
                <id>21</id>
                <name>
                    <![CDATA[Modalités]]>
                </name>
                <slug>
                    <![CDATA[modalites]]>
                </slug>
            </entry>
            <entry>
                <entry>
                    <entry>
                        <![CDATA[self]]>
                    </entry>
                    <entry>
                        <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questioncategories/21.xml]]>
                    </entry>
                </entry>
            </entry>
            <entry/></entry>
    </entry>
    <entry>
        <entry>
            <entry>
                <![CDATA[self]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs/22/questioncategories.xml?page=1&limit=2&offset=0]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs/22/questioncategories.xml?page=2&limit=2&offset=0]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs/22/questioncategories.xml?page=1&limit=2&offset=0]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs/22/questioncategories.xml?page=2&limit=2&offset=0]]>
            </entry>
        </entry>
    </entry>
    <entry/>
</result>
```
