TmsFaqBundle API: [GET] Evaluations
===================================

List all evaluations

## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /faq/evaluations
| **Formats** | json, xml
| **Secured** | false

## HTTP Request parameters
| Name        | Optional | Default | Requirements | Description
|-------------|----------|---------|--------------|------------
| question_id | true     |         | \d+          | Id of the question associated with evaluations
| limit       | true     | 20      | \d+          | Pagination limit
| offset      | true     | 0       | \d+          | Pagination offet
| page        | true     |         |              |
| sort        | true     |         |              |

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
        "type": "Tms\\Bundle\\FaqBundle\\Entity\\Evaluation",
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
                    "href": "http://operation-manager.tessi/app_dev.php/api/faq/evaluations/10.json"
                }
            },
            "actions": []
        },
        {
            "metadata": {
                "type": "Tms\\Bundle\\FaqBundle\\Entity\\Evaluation",
                "serializerContextGroup": "tms_rest.item"
            },
            "data": {
                "id": 11,
                "value": 10,
                "createdAt": "2014-07-31T03:08:33+0200"
            },
            "links": {
                "self": {
                    "rel": "self",
                    "href": "http://operation-manager.tessi/app_dev.php/api/faq/evaluations/11.json"
                }
            },
            "actions": []
        }
    ],
    "links": {
        "self": {
            "rel": "self",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/evaluations?page=1&limit=2&offset=0"
        },
        "nextPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/evaluations?page=2&limit=2&offset=0"
        },
        "previousPage": {
            "rel": "nav",
            "href": ""
        },
        "firstPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/evaluations?page=1&limit=2&offset=0"
        },
        "lastPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/evaluations?page=2&limit=2&offset=0"
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
            </entry>
            <entry/></entry>
        <entry>
            <entry>
                <entry>
                    <![CDATA[Tms\Bundle\FaqBundle\Entity\Evaluation]]>
                </entry>
                <entry>
                    <![CDATA[tms_rest.item]]>
                </entry>
            </entry>
            <entry>
                <id>11</id>
                <value>10</value>
                <createdAt>
                    <![CDATA[2014-07-31T03:08:33+0200]]>
                </createdAt>
            </entry>
            <entry>
                <entry>
                    <entry>
                        <![CDATA[self]]>
                    </entry>
                    <entry>
                        <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/evaluations/11.xml]]>
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
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/evaluations.xml?page=1&limit=2&offset=0]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/evaluations.xml?page=2&limit=2&offset=0]]>
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
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/evaluations.xml?page=1&limit=2&offset=0]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/evaluations.xml?page=2&limit=2&offset=0]]>
            </entry>
        </entry>
    </entry>
    <entry/>
</result>
```