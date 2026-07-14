<?php

$theme_font   = get_option( 'hostinger_theme_font', 'default' ); ?>

<?php switch ($theme_font) :
case 'professional': ?>
body {
    font-family: 'SourceSansPro', sans-serif;
    font-weight: 400;
}

p {
    font-weight: 400;
}
h1, h2, h3, h4, h5, h6 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
}
<?php
break;
case 'modern': ?>
body {
    font-family: 'OpenSans-Regular', sans-serif;
    font-weight: 400;
}

p {
    font-weight: 400;
}
h1, h2, h3, h4, h5, h6 {
    font-family: 'Raleway-Bold', sans-serif;
    font-weight: 700;
}

<?php
break;
case 'elegant': ?>
body {
    font-family: 'Lora-Regular', sans-serif;
    font-weight: 400;
}

p {
    font-weight: 400;
}
h1, h2, h3, h4, h5, h6 {
    font-family: 'PlayfairDisplay-Bold', sans-serif;
    font-weight: 700;
}

<?php
break;
case 'creative': ?>
body {
    font-family: 'Quicksand-Regular', sans-serif;
    font-weight: 400;
}

p {
    font-weight: 400;
}
h1, h2, h3, h4, h5, h6 {
    font-family: 'Lobster-Regular', sans-serif;
    font-weight: 400;
}

<?php
break;
case 'dynamic': ?>
body {
    font-family: 'PTSans-Regular', sans-serif;
    font-weight: 400;
}

p {
    font-weight: 400;
}
h1, h2, h3, h4, h5, h6 {
    font-family: 'Oswald-Bold', sans-serif;
    font-weight: 700;
}
<?php
break;
default: ?>
body {
    font-family: 'Inter', sans-serif;
}

p {
    font-weight: 400;
}
h1,h2,h3,h4,h5,h6 {
    font-weight: 700;
}

<?php endswitch; ?>