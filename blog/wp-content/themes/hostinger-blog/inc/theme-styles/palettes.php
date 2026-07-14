<?php

$palette_name = get_option( 'hostinger_theme_palette', 'palette1' );
switch ($palette_name) :
	case 'palette2': ?>
		:root {
		--main-primary: #176BE0;
		--main-dark: #061933;
		--main-light: #FFFFFF;
		--grey-main: #32475D;
		--grey-lighter: #B8C0CC;
		--grey-light: #DBE5F1;
		--red: #FF0000;
		--max-width: 1400px;
		--view-width: 1158px;
		--border: #DADCE0;
		}
		<?php
		break;
	case 'palette3': ?>
		:root {
		--main-primary: #2E994C;
		--main-dark: #05100B;
		--main-light: #FFFFFF;
		--grey-main: #2E394C;
		--grey-lighter: #B0BBC9;
		--grey-light: #EAF4EC;
		--red: #FF0000;
		--max-width: 1400px;
		--view-width: 1158px;
		--border: #DADCE0;
		}

		<?php
		break;
	case 'palette4': ?>
		:root {
		--main-primary: #F84125;
		--main-dark: #121314;
		--main-light: #FFFFFF;
		--grey-main: #2E394C;
		--grey-lighter: #8798AD;
		--grey-light: #F2F3F6;
		--red: #FF0000;
		--max-width: 1400px;
		--view-width: 1158px;
		--border: #DADCE0;
		}

		<?php
		break;
	case 'palette5': ?>
		:root {
		--main-primary: #D88778;
		--main-dark: #323030;
		--main-light: #FEFEFE;
		--grey-main: #8C8382;
		--grey-lighter: #E8D3D0;
		--grey-light: #F7F1EF;
		--red: #FF0000;
		--max-width: 1400px;
		--view-width: 1158px;
		--border: #DADCE0;
		}

		<?php
		break;
	default: ?>
		:root {
		--main-primary: #6936F5;
		--main-dark: #36344D;
		--main-light: #FFFFFF;
		--grey-main: #727586;
		--grey-lighter: #DADCE0;
		--grey-light: #F2F3F6;
		--red: #FF0000;
		--max-width: 1400px;
		--view-width: 1158px;
		--border: #DADCE0;
		}

	<?php endswitch;