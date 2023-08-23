<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <head>
                <link rel="stylesheet"
                    href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css"></link>
                <title>Product Information</title>
            </head>
            <body>
                <h1>Product Information</h1>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>AverageBP</th>
                        <th>AverageSP</th>
                    </tr>
                    <xsl:apply-templates select="//product" />
                </table>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="product">
        <tr>
            <td>
                <xsl:value-of select="@productId" />
            </td>
            <td>
                <xsl:value-of select="name" />
            </td>
            <td>
                <xsl:value-of select="sum(stock/inventory/quantity)" />
            </td>
            <td>
                <xsl:value-of select="format-number(avg(stock/inventory/pricing/costPrice), '0.00')" />
            </td>
            <td>
                <xsl:value-of
                    select="format-number(avg(stock/inventory/pricing/sellingPrice), '0.00')" />
            </td>
        </tr>
    </xsl:template>

</xsl:stylesheet>