<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>
    <xsl:template match="/">
        <html>
            <head>
                <title>Hyperlink</title>
            </head>
            <body>
                <xsl:element name="a">
                    <xsl:attribute name="href">
                        <xsl:value-of select="parentnode/link_url"/>
                    </xsl:attribute>
                    <span>Recenzii</span>
                </xsl:element>
                <br/><br/>
                <xsl:element name="a">
                    <xsl:attribute name="href">
                        <xsl:value-of select="parentnode/back"/>
                    </xsl:attribute>
                    <span>Inapoi</span>
                </xsl:element>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>