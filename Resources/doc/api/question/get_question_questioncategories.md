TmsFaqBundle API: [GET] Question question categories
====================================================

Retrieve Question question categories


## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /faq/questions/{id}/questioncategories.{_format}
| **Formats** | json|xml
| **Secured** | false

## HTTP Request parameters
| Name                 | Optional | Default | Requirements | Description
|----------------------|----------|---------|--------------|------------
| limit                | true     | 20      | \d+          | Pagination limit
| offset               | true     | 0       | \d+          | Pagination offet
| page                 | true     |         |              |
| sort                 | true     |         |              |

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
        "pageCount": 1,
        "totalCount": 1,
        "limit": 20,
        "offset": 0,
        "id": "33"
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
        }
    ],
    "links": {
        "self": {
            "rel": "self",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/questions/33/questioncategories?page=1&limit=20&offset=0"
        },
        "nextPage": {
            "rel": "nav",
            "href": ""
        },
        "previousPage": {
            "rel": "nav",
            "href": ""
        },
        "firstPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/questions/33/questioncategories?page=1&limit=20&offset=0"
        },
        "lastPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/questions/33/questioncategories?page=1&limit=20&offset=0"
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
        <entry>1</entry>
        <entry>1</entry>
        <entry>20</entry>
        <entry>0</entry>
        <entry>
            <![CDATA[33]]>
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
    </entry>
    <entry>
        <entry>
            <entry>
                <![CDATA[self]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questions/33/questioncategories.xml?page=1&limit=20&offset=0]]>
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
                <![CDATA[]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questions/33/questioncategories.xml?page=1&limit=20&offset=0]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questions/33/questioncategories.xml?page=1&limit=20&offset=0]]>
            </entry>
        </entry>
    </entry>
    <entry/>
</result>
```