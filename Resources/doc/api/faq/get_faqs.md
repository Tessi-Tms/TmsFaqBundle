TmsFaqBundle API: [GET] Faqs
============================

List all Faqs

## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /faqs.{_format}
| **Formats** | json, xml
| **Secured** | false

## HTTP Request parameters
| Name        | Optional | Default | Requirements | Description
|-------------|----------|---------|--------------|------------
| customer_id | true     |         | \d+          | Id of a customer associated with a Faq
| enabled     | true     |         | [0,1]        | Enabled Faq (true or false)
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
        "type": "Tms\\Bundle\\FaqBundle\\Entity\\Faq",
        "serializerContextGroup": "tms_rest.collection",
        "page": 1,
        "pageCount": 2,
        "totalCount": 2,
        "limit": 20,
        "offset": 0
    },
    "data": [
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
                    "href": "http://operation-manager.tessi/app_dev.php/api/faqs/22.json"
                }
            },
            "actions": []
        },
        {
            "metadata": {
                "type": "Tms\\Bundle\\FaqBundle\\Entity\\Faq",
                "serializerContextGroup": "tms_rest.item"
            },
            "data": {
                "id": 23,
                "title": "Test",
                "enabled": true
            },
            "links": {
                "self": {
                    "rel": "self",
                    "href": "http://operation-manager.tessi/app_dev.php/api/faqs/23.json"
                }
            },
            "actions": []
        }
    ],
    "links": {
        "self": {
            "rel": "self",
            "href": "http://operation-manager.tessi/app_dev.php/api/faqs?page=1&limit=20&offset=0"
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
            "href": "http://operation-manager.tessi/app_dev.php/api/faqs?page=1&limit=20&offset=0"
        },
        "lastPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faqs?page=1&limit=20&offset=0"
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
            <![CDATA[tms_rest.collection]]>
        </entry>
        <entry>1</entry>
        <entry>2</entry>
        <entry>2</entry>
        <entry>20</entry>
        <entry>0</entry>
    </entry>
    <entry>
        <entry>
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
            </entry>
            <entry/></entry>
        <entry>
            <entry>
                <entry>
                    <![CDATA[Tms\Bundle\FaqBundle\Entity\Faq]]>
                </entry>
                <entry>
                    <![CDATA[tms_rest.item]]>
                </entry>
            </entry>
            <entry>
                <id>23</id>
                <title>
                    <![CDATA[Test]]>
                </title>
                <enabled>true</enabled>
            </entry>
            <entry>
                <entry>
                    <entry>
                        <![CDATA[self]]>
                    </entry>
                    <entry>
                        <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs/23.xml]]>
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
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs.xml?page=1&limit=20&offset=0]]>
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
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs.xml?page=1&limit=20&offset=0]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs.xml?page=1&limit=20&offset=0]]>
            </entry>
        </entry>
    </entry>
    <entry/>
</result>
```