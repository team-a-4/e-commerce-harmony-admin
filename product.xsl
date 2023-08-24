<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="product">
        <html>
            <head>
                <link rel="stylesheet"
                    href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css"></link>
                <title>Product Information</title>
            </head>
            <body>
                <main class="container">
                    <h1>Product Information</h1>
                    <figure>
                        <table role="grid">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <td>
                                        <xsl:value-of select="@productId" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Category</th>
                                    <td>
                                        <xsl:value-of select="@category" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>Brand</th>
                                    <td>
                                        <xsl:value-of select="brand" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>
                                        <xsl:value-of select="name" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>
                                        <xsl:value-of select="description"
                                            disable-output-escaping="yes" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>Thumbnail</th>
                                    <td>
                                        <img
                                            style="width: 100px; height: 100px;"
                                            src="https://www.rewardhospitality.com.au/images/ProductImages/500/3456172.jpg"
                                            alt="Product Image" />
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </figure>

                    <article>
                        <div class="grid">
                            <div>
                                <h2>Inventory</h2>
                            </div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div>
                                <button onclick="location.href='./addInventory.html'">New Inventory</button>
                            </div>
                        </div>
                        <table role="grid">
                            <thead>
                                <tr>
                                    <th>Inventory ID</th>
                                    <th>Product Barcode</th>
                                    <xsl:choose>
                                        <xsl:when test="stock/inventory/quantity">
                                            <th>Quantity</th>
                                        </xsl:when>
                                    </xsl:choose>
                                    <xsl:choose>
                                        <xsl:when test="stock/inventory/weight">
                                            <th>Weight</th>
                                        </xsl:when>
                                    </xsl:choose>
                                    <th>Production Date</th>
                                    <th>Expiry Date</th>
                                    <th>Cost Price</th>
                                    <th>Selling Price</th>
                                    <th>Profit</th>
                                </tr>
                            </thead>
                            <xsl:apply-templates select="stock/inventory" />
                        </table>
                    </article>
                </main>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="inventory">
        <tr>
            <td>
                <xsl:value-of select="@inventoryId" />
            </td>
            <td>
                <xsl:value-of select="productBarcode" />
            </td>

            <xsl:choose>

                <xsl:when test="quantity">

                    <xsl:choose>
                        <xsl:when test="quantity &lt; 6">
                            <td style="color: red;">
                                <xsl:value-of select="quantity" />
                                <xsl:text> </xsl:text>
                                <xsl:value-of
                                    select="quantity/@unit" />
                            </td>
                        </xsl:when>

                        <xsl:otherwise>
                            <td>
                                <xsl:value-of select="quantity" />
                                <xsl:text> </xsl:text>
                                <xsl:value-of
                                    select="quantity/@unit" />
                            </td>
                        </xsl:otherwise>
                    </xsl:choose>

                </xsl:when>
                <xsl:otherwise>

                    <xsl:choose>
                        <xsl:when test="weight &lt; 6">
                            <td style="color: red;">
                                <xsl:value-of select="weight" />
                                <xsl:text> </xsl:text>
                                <xsl:value-of
                                    select="weight/@unit" />
                            </td>
                        </xsl:when>

                        <xsl:otherwise>
                            <td>
                                <xsl:value-of select="weight" />
                                <xsl:text> </xsl:text>
                                <xsl:value-of
                                    select="weight/@unit" />
                            </td>
                        </xsl:otherwise>
                    </xsl:choose>

                </xsl:otherwise>

            </xsl:choose>

            <td>
                <xsl:value-of select="productionDate" />
            </td>
            <td>
                <xsl:value-of select="expiryDate" />
            </td>
            <td>
                <xsl:value-of select="pricing/costPrice" />
            </td>
            <td>
                <xsl:value-of select="pricing/sellingPrice" />
            </td>

            <td>
                <xsl:choose>
                    <xsl:when test="pricing/sellingPrice - pricing/costPrice &gt; 0">
                        <xsl:attribute name="style">color:green;</xsl:attribute>
                        <text>+</text>
                        <xsl:value-of
                            select="format-number(pricing/sellingPrice - pricing/costPrice, '0.00')" />
                    </xsl:when>
                    <xsl:otherwise>
                        <xsl:attribute name="style">color:red;</xsl:attribute>
                        <xsl:value-of
                            select="format-number(pricing/sellingPrice - pricing/costPrice, '0.00')" />
                    </xsl:otherwise>
                </xsl:choose>
            </td>
        </tr>
    </xsl:template>

</xsl:stylesheet>