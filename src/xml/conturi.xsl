<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0"> 

    <xsl:param name="username"/>
    <xsl:param name="pos"/>

    <xsl:output method="html"/>
    <xsl:template match="/">
        <html lang="en">
            <head> 
            </head>
            <body> 
                <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top bg-dark">
                    <div class="container px-4 px-lg-5">
                        <a class="navbar-brand" style="color: white;" href="index.php">Shooters</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                                <li class="nav-item"><a class="nav-link" style="color: #808080;" aria-current="page" href="index.php">Acasa</a></li>
                                <li class="nav-item"><a class="nav-link" style="color: white;" href="about.php">Despre noi</a></li>
                                <li class="nav-item dropdown" >
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">Bauturi</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="produse.php">Toate bauturile</a></li>
                                        <li><hr class="dropdown-divider" /></li>
                                        <li><a class="dropdown-item" href="populare.php">Shot-uri</a></li>
                                        <li><a class="dropdown-item" href="noi.php">Cocktail-uri</a></li>
                                    </ul>
                                </li>
                                <xsl:if test="$username != ''">
                                    <xsl:choose>
                                        <xsl:when test="$pos = 'admin'">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                                                    <xsl:value-of select="$username"/>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <li><a class="dropdown-item" href="administrareconturi.php">Administrare conturi</a></li>
                                                    <li><a class="dropdown-item" href="administrarebaza.php" style="color: black;">Administrare baza de date</a></li>
                                                    <li><hr class="dropdown-divider" /></li>
                                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                                </ul>
                                            </li>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <a class="nav-link" href="logout.php" style="color: white;">Logout</a>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </xsl:if>
                                <xsl:if test="$username = ''">
                                    <a class="nav-link" href="rememberme.php" style="color: white;">Login</a>
                                </xsl:if> 
                            </ul>
                        </div>
                    </div>
                </nav> 
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Utilizator</th>
                        <th>Parola</th>
                        <th>Pozitie</th>
                        <th>Comenzi</th>
                    </tr> 
                    <!-- <xsl:apply-templates select="root/cont"/> -->
                    <xsl:for-each select="root/cont">
                        <tr>
                            <td><xsl:value-of select="id"/></td>
                            <td><xsl:value-of select="username"/></td>
                            <td><xsl:value-of select="password"/></td>
                            <td><xsl:value-of select="user_type"/></td>
                            <td> 
                                <xsl:element name="a">
                                <xsl:attribute name="href">
                                    <xsl:value-of select="edit"/>
                                </xsl:attribute>
                                <span>Editati     </span>
                                </xsl:element>

                                <xsl:element name="a">
                                <xsl:attribute name="href">
                                    <xsl:value-of select="delete"/>
                                </xsl:attribute>

                                <xsl:attribute name="onclick">
                                    <xsl:value-of select="confirm"/>
                                </xsl:attribute>
                                <span>Stergeti     </span>
                                </xsl:element>
                            </td>
                        </tr>
                    </xsl:for-each>
                </table> 
            </body>
        </html>
    </xsl:template>
    <!-- <xsl:template match="cont">
        <tr>
            <td><xsl:value-of select="id"/></td>
            <td><xsl:value-of select="username"/></td>
            <td><xsl:value-of select="password"/></td>
            <td><xsl:value-of select="user_type"/></td>
            <td>
                <a href="edit.php?id={id}">Edit</a>
                <a href="delete.php?id={id}">Delete</a>
            </td>
        </tr>
    </xsl:template> -->
</xsl:stylesheet>