<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0"> 

    <xsl:param name="username"/>
    <xsl:param name="pos"/> 
    <xsl:param name="tip_bautura"/>

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
                <section class="py-5">
                    <div class="container px-4 px-lg-5 mt-5">
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                            <xsl:for-each select = "root/bautura">
                                <xsl:if test = "not($tip_bautura)">
                                    <div class="col mb-5">
                                        <div class="card h-100"> 
                                            <img class="card-img-top" src="{imagine}" alt="..." /> 
                                            <div class="card-body p-4">
                                                <div class="text-center"> 
                                                    <h5 class="fw-bolder">
                                                        <xsl:value-of select = "nume" />
                                                    </h5>
                                                    <p class="fw-bolder m-auto">
                                                        <xsl:value-of select = "ingrediente" />
                                                    </p> 
                                                    <br/><br/>
                                                    <p class="fw-bolder m-auto">
                                                        Pret: <xsl:value-of select = "pret" /> lei
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </xsl:if>
                                <xsl:if test = "tip_bautura = $tip_bautura">
                                    <div class="col mb-5">
                                        <div class="card h-100"> 
                                            <img class="card-img-top" src="{imagine}" alt="..." /> 
                                            <div class="card-body p-4">
                                                <div class="text-center"> 
                                                    <h5 class="fw-bolder">
                                                        <xsl:value-of select = "nume" />
                                                    </h5>
                                                    <p class="fw-bolder m-auto">
                                                        <xsl:value-of select = "ingrediente" />
                                                    </p> 
                                                    <br/><br/>
                                                    <p class="fw-bolder m-auto">
                                                        Pret: <xsl:value-of select = "pret" /> lei
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </xsl:if>
                            </xsl:for-each> 
                        </div>
                    </div>
                </section>  
            </body>
        </html>
    </xsl:template> 
</xsl:stylesheet>