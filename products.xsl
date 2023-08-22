<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <!-- Match the root element -->
    <xsl:template match="product">
        <html>
            <head>
                <link rel="stylesheet"
                    href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css"></link>
            </head>
            <body>
             <main class="container">
                <h1>Product Information</h1>
                <table border="1">
                    <tr>
                        <th>Product ID</th>
                        <td><xsl:value-of select="@productId" /></td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td><xsl:value-of select="@category" /></td>
                    </tr>
                    <tr>
                        <th>Brand</th>
                        <td><xsl:value-of select="brand" /></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><xsl:value-of select="name" /></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><xsl:value-of select="description" disable-output-escaping="yes" /></td>
                    </tr>
                    <tr>
                     
                    </tr>
                    
                </table>
                <h2>Product Image</h2>
                <img src="https://www.rewardhospitality.com.au/images/ProductImages/500/3456172.jpg" alt="Product Image" />

                <h2>Inventory</h2>
                <table border="1">
                    <tr>
                        
                        <th>Inventory ID</th>
                        <th>Product Barcode</th>
                        <th>Quantity</th>
                        <th>Production Date</th>
                        <th>Expiry Date</th>
                        <th>Cost Price</th>
                        <th>Selling Price</th>
                    </tr>
                    <xsl:apply-templates select="stock/inventory" />
                </table>
                </main>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="inventory">
        <tr>
            <td><xsl:value-of select="@inventoryId" /></td>
            <td><xsl:value-of select="productBarcode" /></td>
            <td>
                <xsl:choose>
                    <xsl:when test="quantity &lt; 4">
                        <xsl:attribute name="style">color: red;</xsl:attribute>
                    </xsl:when>
                </xsl:choose>
                <xsl:value-of select="quantity" />
            </td>
            <td><xsl:value-of select="productionDate" /></td>
            <td><xsl:value-of select="expiryDate" /></td>
            <td><xsl:value-of select="pricing/costPrice" /></td>
            <td><xsl:value-of select="pricing/sellingPrice" /></td>
        </tr>
    </xsl:template>

</xsl:stylesheet>
