TmsFaqBundle API: [GET] Faq questions
=====================================

Retrieve Faq questions

## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /faqs/{id}/questions.{_format}
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
        "type": "Tms\\Bundle\\FaqBundle\\Entity\\Question",
        "serializerContextGroup": "tms_rest.collection",
        "page": 1,
        "pageCount": 2,
        "totalCount": 23,
        "limit": 2,
        "offset": 0,
        "id": "22"
    },
    "data": [
        {
            "metadata": {
                "type": "Tms\\Bundle\\FaqBundle\\Entity\\Question",
                "serializerContextGroup": "tms_rest.item"
            },
            "data": {
                "id": 33,
                "question": "pourquoi on me dit que je n'ai pas respecté les dates de l'opération ?",
                "answer": "Pour être éligible à une offre de remboursement SFR, vous devez impérativement souscrire et activer votre ligne SFR ou encore acheter un produit SFR pendant une période définie. Cette période est indiquée dans les modalités de participation que vous pouvez retrouver sur notre site www.sfr.odr.fr. Si vous n'avez pas respecté cette période ou si vous avez effectué un renouvellement de mobile ou une migration, alors que ces actes ne sont pas éligibles à l'offre, vous ne pourrez pas prétendre à un remboursement. En revanche, si le numéro de ligne SFR renseigné sur le courrier de non-conformité  est erroné, nous vous invitons à nous retourner par courrier votre dossier de participation dans son ensemble, avec toutes les pièces justificatives initialement demandées, accompagné du courrier de non conformité à l'adresse suivante : SFR PROMOTIONS - CEDEX 3243 - 99324 PARIS CONCOURS . Précisez-nous le n° de la ligne SFR qui fait l'objet de la demande de remboursement, ainsi que le numéro et le nom de l'offre de remboursement à laquelle vous avez participé. Votre dossier sera alors ré-examiné.",
                "average": 1.5,
                "countYep": 0,
                "countNope": 0
            },
            "links": {
                "self": {
                    "rel": "self",
                    "href": "http://operation-manager.tessi/app_dev.php/api/faq/questions/33"
                }
            },
            "actions": []
        },
        {
            "metadata": {
                "type": "Tms\\Bundle\\FaqBundle\\Entity\\Question",
                "serializerContextGroup": "tms_rest.item"
            },
            "data": {
                "id": 34,
                "question": "j'ai envoyé trop tard ma participation",
                "answer": "Pour être éligible à une offre de remboursement SFR, vous devez  'poster' votre dossier de participation, par courrier ou en ligne sur notre site internet, avant une date limite. Cette date est indiquée dans les modalités de participation que vous pouvez retrouver sur notre site www.sfr.odr.fr. En général, si vous participez par courrier, il vous est demandé de renvoyer votre dossier dans les 30 jours qui suivent votre achat. Si vous n'avez pas respecté cette date limite de renvoi, vous ne pourrez malheureusement pas prétendre à un remboursement.",
                "average": 0,
                "countYep": 0,
                "countNope": 0
            },
            "links": {
                "self": {
                    "rel": "self",
                    "href": "http://operation-manager.tessi/app_dev.php/api/faq/questions/34"
                }
            },
            "actions": []
        }
    ],
    "links": {
        "self": {
            "rel": "self",
            "href": "http://operation-manager.tessi/app_dev.php/api/faqs/22/questions?page=1&limit=2&offset=0"
        },
        "nextPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faqs/22/questions?page=2&limit=2&offset=0"
        },
        "previousPage": {
            "rel": "nav",
            "href": ""
        },
        "firstPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faqs/22/questions?page=1&limit=2&offset=0"
        },
        "lastPage": {
            "rel": "nav",
            "href": "http://operation-manager.tessi/app_dev.php/api/faqs/22/questions?page=12&limit=2&offset=0"
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
            <![CDATA[Tms\Bundle\FaqBundle\Entity\Question]]>
        </entry>
        <entry>
            <![CDATA[tms_rest.collection]]>
        </entry>
        <entry>1</entry>
        <entry>2</entry>
        <entry>23</entry>
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
                    <![CDATA[Tms\Bundle\FaqBundle\Entity\Question]]>
                </entry>
                <entry>
                    <![CDATA[tms_rest.item]]>
                </entry>
            </entry>
            <entry>
                <id>33</id>
                <question>
                    <![CDATA[pourquoi on me dit que je n'ai pas respecté les dates de l'opération ?]]>
                </question>
                <answer>
                    <![CDATA[Pour être éligible à une offre de remboursement SFR, vous devez impérativement souscrire et activer votre ligne SFR ou encore acheter un produit SFR pendant une période définie. Cette période est indiquée dans les modalités de participation que vous pouvez retrouver sur notre site www.sfr.odr.fr. Si vous n'avez pas respecté cette période ou si vous avez effectué un renouvellement de mobile ou une migration, alors que ces actes ne sont pas éligibles à l'offre, vous ne pourrez pas prétendre à un remboursement. En revanche, si le numéro de ligne SFR renseigné sur le courrier de non-conformité  est erroné, nous vous invitons à nous retourner par courrier votre dossier de participation dans son ensemble, avec toutes les pièces justificatives initialement demandées, accompagné du courrier de non conformité à l'adresse suivante : SFR PROMOTIONS - CEDEX 3243 - 99324 PARIS CONCOURS . Précisez-nous le n° de la ligne SFR qui fait l'objet de la demande de remboursement, ainsi que le numéro et le nom de l'offre de remboursement à laquelle vous avez participé. Votre dossier sera alors ré-examiné.]]>
                </answer>
                <average>1.50</average>
                <countYep>0</countYep>
                <countNope>0</countNope>
            </entry>
            <entry>
                <entry>
                    <entry>
                        <![CDATA[self]]>
                    </entry>
                    <entry>
                        <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questions/33.xml]]>
                    </entry>
                </entry>
            </entry>
            <entry/></entry>
        <entry>
            <entry>
                <entry>
                    <![CDATA[Tms\Bundle\FaqBundle\Entity\Question]]>
                </entry>
                <entry>
                    <![CDATA[tms_rest.item]]>
                </entry>
            </entry>
            <entry>
                <id>34</id>
                <question>
                    <![CDATA[j'ai envoyé trop tard ma participation]]>
                </question>
                <answer>
                    <![CDATA[Pour être éligible à une offre de remboursement SFR, vous devez  'poster' votre dossier de participation, par courrier ou en ligne sur notre site internet, avant une date limite. Cette date est indiquée dans les modalités de participation que vous pouvez retrouver sur notre site www.sfr.odr.fr. En général, si vous participez par courrier, il vous est demandé de renvoyer votre dossier dans les 30 jours qui suivent votre achat. Si vous n'avez pas respecté cette date limite de renvoi, vous ne pourrez malheureusement pas prétendre à un remboursement.]]>
                </answer>
                <average>0.00</average>
                <countYep>0</countYep>
                <countNope>0</countNope>
            </entry>
            <entry>
                <entry>
                    <entry>
                        <![CDATA[self]]>
                    </entry>
                    <entry>
                        <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questions/34.xml]]>
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
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs/22/questions.xml?page=1&limit=2&offset=0]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs/22/questions.xml?page=2&limit=2&offset=0]]>
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
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs/22/questions.xml?page=1&limit=2&offset=0]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <![CDATA[nav]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faqs/22/questions.xml?page=12&limit=2&offset=0]]>
            </entry>
        </entry>
    </entry>
    <entry/>
</result>
```
