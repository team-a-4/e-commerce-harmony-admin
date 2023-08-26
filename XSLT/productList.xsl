<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <head>
                <link rel="stylesheet"
                    href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css"></link>
                <title>Inventory</title>
                <script src="../JS/product.js"></script>
            </head>
            <body>
                <main class="container">
                    <div class="grid">
                        <div>
                            <h1>Inventory</h1>
                        </div>
                        <div></div>
                        <div></div>
                        <div>
                            <button onclick="location.href='./../addProduct.html'">Add Product</button>
                        </div>
                        <div>
                            <button onclick="location.href='/e-commerce-harmony-admin/PHP/addProductWithXML.php'">Upload xml</button>
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
                        <a href="javascript:void(0);" onclick="loadProduct({@productId})">
                            <xsl:value-of select="@productId" />
                        </a>
                    </td>
                    <td>
                        <xsl:value-of select="name" />
                    </td>
                    <td>
                        <xsl:value-of select="brand" />
                    </td>

                    <xsl:variable name="sumQuantity" select="sum(stock/inventory/quantity)" />
                    <xsl:variable name="sumWeight" select="sum(stock/inventory/weight)" />
                    <xsl:choose>
                        <xsl:when test="$sumQuantity  &gt; 0">
                            <td>
                                <xsl:value-of select="$sumQuantity" />
                                <xsl:text> </xsl:text>
                                <xsl:value-of
                                    select="stock/inventory/quantity/@unit" />
                            </td>
                        </xsl:when>
                        <xsl:when test="$sumWeight  &gt; 0">
                            <td>
                                <xsl:value-of select="$sumWeight" />
                                <xsl:text> </xsl:text>
                                <xsl:value-of
                                    select="stock/inventory/weight/@unit" />
                            </td>
                        </xsl:when>
                        <xsl:otherwise>
                            <td style="color: red;">
                                <xsl:text>Out of Stock</xsl:text>
                            </td>
                        </xsl:otherwise>
                    </xsl:choose>


                    <td>
                        <xsl:variable name="avgCostPrice"
                            select="sum(stock/inventory/pricing/costPrice) div count(stock/inventory/pricing/costPrice)" />
                        <xsl:choose>
                            <xsl:when test="not($avgCostPrice)">
                                <xsl:text>-</xsl:text>
                            </xsl:when>
                            <xsl:otherwise>
                                <xsl:value-of select="format-number($avgCostPrice, '0.00')" />
                            </xsl:otherwise>
                        </xsl:choose>
                    </td>
                    <td>
                        <xsl:variable name="avgSellPrice"
                            select="sum(stock/inventory/pricing/sellingPrice) div count(stock/inventory/pricing/sellingPrice)" />
                        <xsl:choose>
                            <xsl:when test="not($avgSellPrice)">
                                <xsl:text>-</xsl:text>
                            </xsl:when>
                            <xsl:otherwise>
                                <xsl:value-of select="format-number($avgSellPrice, '0.00')" />
                            </xsl:otherwise>
                        </xsl:choose>
                    </td>
                    <td>
                        <xsl:variable name="inventoryCount" select="count(stock/inventory)" />
                        <xsl:choose>
                            <xsl:when test="$inventoryCount = 0">
                                <xsl:text>-</xsl:text>
                            </xsl:when>
                            <xsl:otherwise>
                                <xsl:value-of select="$inventoryCount" />
                            </xsl:otherwise>
                        </xsl:choose>
                    </td>
                </tr>
            </xsl:for-each>
        </tbody>
    </xsl:template>
</xsl:stylesheet>