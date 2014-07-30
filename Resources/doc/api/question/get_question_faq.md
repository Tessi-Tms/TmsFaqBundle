TmsFaqBundle API: [GET] Question Faq
====================================

Retrieve Question Faq


## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /faq/questions/{id}/faq.{_format}
| **Formats** | json, xml
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
        "type": "Tms\\Bundle\\FaqBundle\\Entity\\Faq",
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
                }
            },
            "actions": []
        }
    ],
    "links": {
        "self": {
            "rel": "self",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/questions/33/faq?page=1&limit=20&offset=0"
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
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/questions/33/faq?page=1&limit=20&offset=0"
        },
        "lastPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/questions/33/faq?page=1&limit=20&offset=0"
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
    </entry>
    <entry>
        <entry>
            <entry>
                <![CDATA[self]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questions/33/faq.xml?page=1&limit=20&offset=0]]>
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
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questions/33/faq.xml?page=1&limit=20&offset=0]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questions/33/faq.xml?page=1&limit=20&offset=0]]>
            </entry>
        </entry>
    </entry>
    <entry/>
</result>
```