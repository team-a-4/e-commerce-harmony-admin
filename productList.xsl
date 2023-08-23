<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <head>
                <link rel="stylesheet"
                    href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css"></link>
                <title>Inventory</title>
            </head>
            <body>
                <main class="container">
                    <div class="grid">
                        <div>
                            <h1>Inventory</h1>
                        </div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div>
                            <button onclick="location.href='./addProduct.html'">Add Product</button>
                        </div>
                    </div>
                    <table role="grid">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Quantity/Weight</th>
                                <th scope="col">Average Buying Price</th>
                                <th scope="col">Average Selling Price</th>
                                <th scope="col">Inventory Entries</th>
                            </tr>
                        </thead>
                        <xsl:apply-templates select="products" />
                    </table>
                </main>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="products">
        <tbody>
            <xsl:for-each select="product">
                <tr>
                    <td>
                        <a href="./product.xml">
                            <xsl:value-of select="@productId" />
                        </a>
                    </td>
                    <td>
                        <xsl:value-of select="name" />
                    </td>
                    <td>
                        <xsl:value-of select="brand" />
                    </td>
                    <td>
                        <xsl:value-of select="sum(stock/inventory/quantity)" />
                    </td>
                    <td>
                        <xsl:value-of
                            select="format-number(sum(stock/inventory/pricing/costPrice) div count(stock/inventory), '0.00')" />
                    </td>
                    <td>
                        <xsl:value-of
                            select="format-number(sum(stock/inventory/pricing/sellingPrice) div count(stock/inventory), '0.00')" />
                    </td>
                    <td>
                        <xsl:value-of select="count(stock/inventory)" />
                    </td>
                </tr>
            </xsl:for-each>
        </tbody>
    </xsl:template>
</xsl:stylesheet>
