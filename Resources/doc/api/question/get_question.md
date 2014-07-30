TmsFaqBundle API: [GET] Question
================================

Retrieve one question


## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /faq/questions/{id}.{_format}
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

## HTTP Response content examples
### json
```json
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
        },
        "embeddeds": {
            "faq": {
                "rel": "embedded",
                "href": "http://operation-manager.tessi/app_dev.php/api/faq/questions/33/faq"
            },
            "categories": {
                "rel": "embedded",
                "href": "http://operation-manager.tessi/app_dev.php/api/faq/questions/33/questioncategories"
            },
            "evaluations": {
                "rel": "embedded",
                "href": "http://operation-manager.tessi/app_dev.php/api/faq/questions/33/evaluations"
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
        <entry>
            <entry>
                <entry>
                    <![CDATA[embedded]]>
                </entry>
                <entry>
                    <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questions/33/faq.xml]]>
                </entry>
            </entry>
            <entry>
                <entry>
                    <![CDATA[embedded]]>
                </entry>
                <entry>
                    <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questions/33/questioncategories.xml]]>
                </entry>
            </entry>
            <entry>
                <entry>
                    <![CDATA[embedded]]>
                </entry>
                <entry>
                    <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questions/33/evaluations.xml]]>
                </entry>
            </entry>
        </entry>
    </entry>
    <entry/>
</result>
```