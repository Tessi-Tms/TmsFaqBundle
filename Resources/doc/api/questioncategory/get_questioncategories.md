TmsFaqBundle API: [GET] Question categories
===========================================

List all question categories

## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /faq/questioncategories.{_format}
| **Formats** | json, xml
| **Secured** | false

## HTTP Request parameters
| Name     | Optional | Default | Requirements | Description
|----------|----------|---------|--------------|------------
| faq_id   | true     |         | \d+          | Id of the Faq associated with question categories
| limit    | true     | 20      | \d+          | Pagination limit
| offset   | true     | 0       | \d+          | Pagination offet
| page     | true     |         |              |
| sort     | true     |         |              |

## HTTP Response codes
| Code | Description
|------|------------
| 200  | Ok
| 400  | Bad request (wrong query parameters)
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
        "offset": 0
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
                    "href": "http://operation-manager.tessi/app_dev.php/api/faq/questioncategories/20.json"
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
                    "href": "http://operation-manager.tessi/app_dev.php/api/faq/questioncategories/21.json"
                }
            },
            "actions": []
        }
    ],
    "links": {
        "self": {
            "rel": "self",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/questioncategories?page=1&limit=2&offset=0"
        },
        "nextPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/questioncategories?page=2&limit=2&offset=0"
        },
        "previousPage": {
            "rel": "nav",
            "href": ""
        },
        "firstPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/questioncategories?page=1&limit=2&offset=0"
        },
        "lastPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/questioncategories?page=2&limit=2&offset=0"
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
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questioncategories.xml?page=1&limit=2&offset=0]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questioncategories.xml?page=2&limit=2&offset=0]]>
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
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questioncategories.xml?page=1&limit=2&offset=0]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questioncategories.xml?page=2&limit=2&offset=0]]>
            </entry>
        </entry>
    </entry>
    <entry/>
</result>
```