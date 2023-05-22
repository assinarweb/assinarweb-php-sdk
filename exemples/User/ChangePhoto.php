<?php

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Service\UserService;
use AssinarWeb\Models\Photo\Photo;

ini_set("display_errors", 1);
ini_set("display_startup_erros", 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$apiContext = new ApiContext();
$apiContext->setDomain(ApiContext::DOMAIN_LINK);
$apiContext->setEnvironment(ApiContext::HOMOLOGATION_ENVIRONMENT);
$apiContext->setPartnerPrefix(ApiContext::PARTNER_PREFIX_LINK);
$apiContext->setApiToken('eyJ0eXAiOiJKV1QiLCJhbGciO...');

$photo = new Photo();
$photo->setImage("data:image/jpg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wAARCAIbAhsDASIAAhEBAxEB/8QAHAAAAQUBAQEAAAAAAAAAAAAAAAIDBAUGAQcI/8QAPBAAAQQBAwIFAwIFAwMEAgMAAQACAxEEBSExEkEGEyJRYRQycQcjJDNCgaE0UpEVJXNDU3KxYsE1Y9H/xAAZAQEBAQEBAQAAAAAAAAAAAAAAAQIDBAX/xAAiEQEBAQEAAwEAAQUBAAAAAAAAARECAyExEkEEIjJRYUL/2gAMAwEAAhEDEQA/APX1xCCvY5OWuWEJNlEBK5+Fwm0B1IJcDvSVNx3ehV2O4EKdA4dKz1CJKLXAbHKFxrcdq1GnbQ2UhMz8LXJcMUOklRlLr0FRSKC6yuRtIICcpN791UJSCE4kIGz7JsssJ0hIcFAwWHsUgOI5T7gANkggHkKMoOeQY1RO9JWgyoA+MgHdZ2cmOQgLFZLB90Wmw6xzuug2PlY1CkBJL2t5Kjz5jI+XJPbM9pTiGm72SPMb7qlydcgiBHmAqpPiaDq2OyfmrjYNe0nYp0uAWTxNfhleAXUruLNa4bG0sqVZfgrhCaika7cu2T7iKNFSoZkKaspxwttkpBATAldXEBaHapAscIC6L9lAoIGyTZSuUUDldoBcXbKDq4aq7SlwbcIO0hcs3suouuUENCN6QHb8KyIn6V/rGr0DTR/DrAaUP40Ut/pv+mVvx6PEmoXULD1BCEKKEIQgEIQgEIQgEIQgEIQgEIQgpCQuXsu0kr1vM5aSu9lxQHCbdylu24SXUgciNDZTMd/pN8qAxwCfid8q32LBj08CoTJFJY8FceospxNT/anQU1Nu1SFpsD0FRy2xupA+1NONcLpGDRATRCdcfZMl3wtIQkJRKSgQbXE4RsmlAlw3pIIThCSjJiTdpKzOUQJ3WVpMl3RGSSAsNqmothneS4V+Vi81nEpz2WSbUGfPbE4+sD+6zWd4jbG0+W5ZnK1qeQ9Rft7J+CRt8vX4o2khwWXzvEcsshDXen8rOy5b5hRcUz1joq1qcNTlKn1KR0htxRHltdzwqh1l97pQkcBQXT8xv8xctyix4c1xV9perSGTpc81+VjWTdMXUV1mfJG7qas3mJeXreLqjOgB7wFZwZ8bmbG147Fq03d5Vvia9JG0DqN/lc7w5/h6mMhrmbbldBDhzusfp+vNf9zlcY2qRyE07dS81ixchA+EzBOJCfbsnwPZZvpK5a6Fzdd3pQKAHddRwPdcFl3wilAbbri7uikAHLqT0pSA4QDsuEriBVoSRS6SqLHSK+sXoGnD+FC890a3Za9E08fwrVq/Hp8USl1cXVzekIQhRQhCEAhCEAhCEAhCEAhCEAhCEFJ+ElF0het5iEd0IUHHbptLcU2SiaEuN+6asrkZo+6GpzX18qVG7YHsq5riFKjl7E7JYqex1rkv8tNxv+Ut56o1zsxNIaRRTT+E8wBNPGy1EMHZIErDynHjZQHMI4WkS3RscPSU0Y637KOHuYO6cE+1EbJqaUfwmyNk6JGuXC0FQ0wSmZJQxtp+UdIJWI8UeJo9OYWB3r+EkMP+I9diw8R5L9x2XjOqa3JlyuIf6SfdI1nXMnPkdb3FpWfdITyVvFxNlynOFWor5jwAoz5Q12y4H9TrVxqcnTMQjzL4NKO55JKT1qYYlscHjldH3AWogJA2KdbJuPf3TVPO+2k22Pfpu047jZJZHXCYuEvY4HlLZIb7ros8pIFHZMT8pjcyVjOprqU/B1x0Mo63EgqmAvum7PWR7KVLy9T0jWWzBo6ha1GPk+Y2wQV4nhZkmLMCxxW80TXhJs5wXO8uNjdCjwldPyoGPmtkYDYtTWODgN1zsxm+iqPYpVnuuCkotscqI4gldSOoIOdZXbKK9iugBAjq33COoEc0l0D2R0N9kCRXuuEE8bJwN9R9kVurBY6G0jJteg6f/pGLBaLvkFb/AARWKxXr49Pi9pKEIWHpCEIUUIQhAIQhAIQhAIQhAIQhAIQhBRIXCd0L1PMSeEBCECXAFNrp2XLCMkFEfK4SiI+pBIbxuutdukk2NlzerREtkhHdSg+2KuDgpMcm1JZqpUaQ8Ck7GNtk29YgZIvlR3REqUUiytohOiISDGprqTb2itlGUIjdHW4cFPmJMujIBQU2ta0zT8VzpDuvC/EOruz8p73uAHZb79RMpzCY7PSV47mygyG1Y1PaPLMTsDsmtq3XQwOaHBc6fcrbUhojq7pbaSSzp2vdLjZvvwjWEFldkkMNE1/ZSyLF8BcrdTTEbpo1yutBqq3UkNIF1YQyIl11soYIN2/KejYSuxwOUuPHI4CmtSaieQaSTH08hWbca0l2HfwmrioeL+Ehg6OTasJsNQHR9JNqxi+ig72U3Ey3QO6mcKC1tHlOEmq7K3Gby2ek+JPWGSmgtpgamzI4cCvHIXlriSdgr/RNZOPKGuJpc7HOx65Geoe6c4VTpma3IhBad1bjcLlfTlY5fukFuyUdx8oJUHQ0UugJICWG13VHBygIO3C5dIOjZFo5Xa+Ugs9E/wBSb4XoGH/p2LA6ILnK3+GKx2K9fHp8J9CELD1BCEKAQhCAQhCAQhCAQhCAQhCAQhCChR23XVzlet5iVzsurnejagbSSEopJtGTRKIzTl0hcj+5NEjhFrgXUHbCdZJumEDbhEXMR2SXjldx6c1deBuuf8hkhMOdRT5UWT7l01NcLkkmwuLmwUQWkvOyLKbkcGsJJQeV/qOGrxnKaTK7awvVv1CzBNmOgZv08leby45BcArG5Fe2wNwuGPblThj0Nxa46IEbClvW5EQM3s8pQZQpSPK24XWxEnhTWjHSXCq2TjIL5ClMxye1KUzGoLOkmq+OE1VbKRDjkGiFMZD8J9kfwprf5Ro8X4UxuOAOLTrQAn4iO6jUiKIAOAnHYwI4UgAFK6U1fyrJ8c9gqLMg6D9q172h3ZU2oY/VZATlzsZ9u53CU412S3t6HVW644bLcc76JBseyVGekWkCyu/0/K1YljeeEdU9YiJ/5XocUvUwGl4ho+a/BzQ69l6zomc3KxwWlcby8/S5v1bJNJTQF12w2WcYF7LgdfK6wdSCyllNJLt0BwB5SDzumJXtaeUNSjIEkyBV8uexjbKinV4991Z7We2z8PvDshy9Bxv5DF5b4QzmZU7+kcL1PHH7DFe5kerxejyEIXN6ghCFAIQhAIQhAIQhAIQhAIQhAIQhBRLiEL1vMSkuJ90oG02STyomuX8JJJSrKQUQkpLAQ9BK4z71EPgpVpPZCo6hcJQgtsM+hPPG5UTCdYAUx/dc79VHIUOT7ypxChSin8rbBoriEHhAm1T69nDCwXuJ9VbK1caBPC8/8X6kJZ/p2f3ReZrB6qXZMssjrcXFUpxPUT3WhnpQn0OArrtJirEFDcJl+P8ACsXJt5UXFf5JJqkpsFcKSildWQlsW26WGhKa2+U6GLLfJtjU4G1wlBoHAQiuAWlBFIRZD7E4E3HwnunZZaJpRsiAOYpfSkPbYpWVLGVzIC2W62UboFHdXmbACSqh0dHZblcrEPeygpxzQCd00Sta5hjqkteg+DcwH0Fy88Zs/wCFpfDGWIs1o4BKzY5dR7BGeobJTmkjlNYZ6oGuvchLJI/C5OBTD0DlB9+yGx21dI9FUssmH8EqoyXGzZVw4eggqlyTZKDP6vqQxmi91Qu1h1bUpviUV0glZwVdLpzHTl6z+l+ScmTJc5tdLgF7jCKiaF4Z+kLbZmE95AvdYxUYU8nx6fHC0IQuL0hCEIBCEIBCEIBCEIBCEIBCEIBCEIKFCEL1vMQ8JG3T8pb02diomOJJXbKSiGyUN+5BXAfUoh4G0vp+UhuyUro7S4UIKCbgOpysHDlVmAfUrQndc79VHJ9woc20isHb2oGQPWtSsUwj+ldXFRXatltw8B8jiAV5Jn5bsid0jiCTwtr42zw2P6dp3PIXnjzbjfZHbiGZXE8lRXuT8jgoryjeGy5MOcnHFMlFc6kpu/KRslMKEh5qftMApYco3C1ywuF9JIcEC7XRSbtLajUqRGpDdwo0dqVGCstSFBqZfspNJmZtg0iVVZVKqkjN3eytckWCq+X7SO61K52K2b0qKTfZS5hYTTWU2ytuNMNtp4sKfpMxjzYwNjfKgFpaKUvEps7SDuFbHPqPbtKcZMNm+1KbW1Kq8PSPk0yM7XStlwvpwLaB0oJN32QDsgn0rLCPKbaaVJkjptXUgppVHOSepBjfEriXtsrPgK/8R7zV2VCF15jrzNeufpAD9Nkn/wDsC9wZ9oC8U/SEfwuRtzIF7Y0bLPkenxwpCELi9AQhCAQhCAQhCAQhCAQhCAQhCAQhCCgsoJXFwr1vM6RY5TVerlKIobJNKJpBXCulJJRkgpDTb0t/GybaaNhQSUqwkApeyDgtBtdFoJV0SMA+vdWtbqpwj+4rZc6ps2omQPUppUPJNFWMIpSXnojc66oJSg6tMINLyJLrpatEeWeJM45epyvuw0+n4VA921qRlSl8rnE3fKikXyjvyjyEphxT8g3TDgjoZcU3SeICT0oGugpxjEsBKsNskUFFwkNpdpR5Mhjdr3QMpvuhp19pLS5IdOPhKZOy+UNPNBPKfjjKaikjJolTYg0nbcKa1DkUZIUhrKXYwOydLVHSG6Tbm2nyE2RSzqqjJhLTSp5yRey0eQ0ngKizY+lbjj0qZepcjPUKJT0jQowFOJvZdHCm5LLiEuDY3e6CyzdojbUqusV7R4YAGjw9yQrk2qDwo8u0mL4C0B4XDp56WBshw2RHvyh/2rLCNMLjPZUWRTA7a1e5B/beqObYFIjE+ISTPXBVCCr3xHtl8KjaF2jvw9o/SEfwMp7mRezN+1eP/pEytMJHJkXsDeFjyvT4ykIQuLuEIQgEIQgEIQgEIQgEIQgEIQgEIQgz64urh2XreXSbKSu/hcOyiEFNk7JwpspqEkpvuEo37pNqCSOF1cH2oQLQgflcspgdwzUquVS4x/fV2OAs9KSQoWULU4qHkJGEQhUXix5j8PZNGrbur5yznjFwHh2e/Zawjx6R3U8jsldtymXSNa5xNKNJmjsUduadeU09NDJDu675nWjrHK2RScLPYpQjU1ZDB9Kg5eQRteynTAjhQpMcvRVY+R3VtVrn7wPBVgMIl91/hTcfTvNeB2TWcVLWSlluG6UA8cArUnTI2Re5UM4DL5RcUjXSB1i7VxhzuDN0pmm9XCfZhPa3YLLUibjS9anhnVwqyGCRnYq1x6Jo8rOukhJiTJYp5YmHMHsoqG5nuqLUYqJ2Wilq1Tao3ut81jtmZWkOItRXilNyAPMKjloJHVuus9vLYQ3hKa23Wgs6e6Gu6SK3S+mOnsHhFtaRHav7CoPC7wNJiFVsr4Bca4WFttD7pdCHLLmjZAAjdvao5hd2rzJdURrlUc12dkiMN4jkLszZUzFa+IHVnGgqhrl2jtxce5/pGP8AtLSe7166AvJv0kb/ANmhPu9eshc/L9erxewhCFydwhCEAhCEAhCEAhCEAhCEAhCEAhCEGfXHbrpBXDwvVryEXSS42upCDiQUtNkqIQ4eyRtaUTSQeLRUoJSbadktB1CEKocxx+8rwcBUWNZnV6OAudI4QomSFMUbIbsnLKC8rF/qHqEeJobo3EdT+y2bxQK8T/VDU5MnU24g+xq6EYOfPc8u6dgoX1D3PIBKd+mcdv8AK6MJ0Z6q3Ux2kcZkvHdTYMncWoYj9VFSGNpMbi2hPWN1MY0EcKtx3kDlW+M0PoLNjfJmTFc8bBIGHXIV8zHHTsFFy4ugcLLrivbjt9k8CyH2Ca8/o5Vfm5zWCi7dVmxYS5gbyVCOay+VQSakXyFrLKGzPdyFpnWlx8xvVVq6xOiWtwsNC9w4tXuBmFtWSFLFlbKLBZI29kOwhGbHKb0/MD2gXurQkPC5ukqtdEQosjKVtLGOyr52qKrHtJ5VVqdmM0FdStobKrzt49wtxjr2yc49RKacPVsFLna0PIpdxMYyHhdJXnkQMgFjASjAjfPKAASFL1HGcZAxrVqPCehGQiRwpo9wpenTnx60uiStx8OKN3ZX8c7SebVS7GbC8gECuE1DmCPObC41a41PJ4JJrRtNhDjskwm2A2lOshV83uZcRZqEZJVJPdmld5O8RpUkxonuiMFr5Jzn37qoa33Vprr+rUpBW1qubud125jpy96/SZoGh49f7ivVAvMP0pAGg4xXp65+X69fhCEIXJ3CEIQCEIQCEIQCEIQCEIQCEIQCEIQZ+1x10url9S9OPIbOyQlnflIKqOHlNkj2SjaQSoEFNWnTSaQSm1WyWm4h6OU4EHQlUEmwu2VdDuMB5yu69KpsQXOrn+hc+iRwqPkcKQmMgehOUsQJW235Xj36h6DIMh2U1tg917I9Umvaa3UNMkjIBdWy6JHzk9pibuKUKfPLBXTZV3ruM7GypIDsWGlQSQ1zuUduaYOoOabLU7HqjCaIUSeIgVSgOPS8qtNbi5QIHcK806YOk5WM07JLvTa0+E4tcDS5104rYY9Obyms+EmO1FxcrpbuVJyMpr2dll11m8u2WsvmymSbpatNqUgo0s4YAJeolaxzpvHxXEW0bp5zXsfThS0eh6X57LfQVV4gxzj5dN3CrJvGt3Av/wDQVtHjkMvuoWj48x0rJywwuF9AI7FWEckjDE17dnDdFidp8roX0SVpIMq27rOPaI2hwT0eWTsDsueOsrR+cHcFQ5nWosORYXXSWo0bkcq/Ib1tIU2TjYqFK22FajFZfLaRkkK60jBuPrKrMpgOQT7lbHScYNw22OVq1jnnVRJpZmzAa2W005seBglp2cfhRMeBjJbcBahajkPbkBrLoLla9M5kSsnJc6a+ypNZy/J1aF7XbFWMNzN3tUmtwEZcKROvj0PT5POw2PHcKXVN2NqDooH/AEuKz2UyT7VXxvLPaJkmovZU0g2JpXGXboyqWZ1g3wjlrA610nPk2VczlTdZNZ0le6hR0u/Lry+g/wBLYwNBxdl6UvPP0xbWh4v4Xoa4+T69fh+aEIQubuEIQgEIQgEIQgEIQgEIQgEIQgEIQgoaCQapdL/hJ5C9TyEFIKcITaISU0l2kFQIcPZJoJTjXCbKJp+Ldm2yctNRn0pxDSwujlJBXUNSsIETq5r0qmw3XPuFc/0rHTXPtxR8j7FIKYn+xTlKgONptzeppB7p0ik3a6svnzx9C7F8R5IDaDjYVFpmnPzmuedqW9/UzDb/ANaD6vqYsjhZv0DXREDpPdNduYp9e012OwFh3WWcd7K2+r5DMyE9LhYWSfhvc8gAgJrSRo8bnzWAtbjROCqdDxCyMvK0eO0eyxa6cQ4HOa3ZMumLm0SbUt8foUOSMhZ11xDyR1MNqqlPqoNVy9pIohQJIfVdbLUrF5WOj6s3HHS6qTOteVnEyNKjxwD/AGhSI4L7JpjmlT5seA/ToRUD3dbttyVcs06QAPkdVcJGHUJstCfnzvQU1ZETKlDfQEYxLhdKEXGfItWmNH0MuljViS00jr35SUj+pRu06TaYkHpTwGyQ8bLUjFqgymhuU2wtphPDMCM2OFjtRIE93utLjPcdLj37JV4ThlNc61V6hlvjlo9JT8LHGyqTUcxhc5t7grnjrq+wdQifH6qBUHVmieeKRu7QVmjmuaaba0Gmh8+Ixzzy4KyM2+noGmx+Xp0IH+3dPvGyTAwx4zG3/SlvOyr43lu1ByTULvdUkw9JCu8raNyppuHWrI5POtXNZ8le+6isapOpG86X5KjMNn2XXmu/MfRv6atrQ8X/AOK36wv6dNDdExf/ABrdLl5Pr1+L4EIQubsEIQgEIQgEIQgEIQgEIQgEIQgEIQgz7h7JBPwl2kF2y9TyOElNlKSEQlNpZTZUCXBN38Jw/lNW4H3Rk/Fu1OBNQmmp0IOpQF90gJQCCXhH99XX9KpMIj6gbK7HC59N8ElMTX0J8pqX+WU5SxBdym6CdcE2V1ZeT/qJ6taYOwYsPlY7XCwAtx4/o64b/wBqxkjlHfhRzxBgIAUMQOc7poq5liBRBBctkKNYXiQ/T4waRuVYY4KZIsqXAzZZtduIfLbFFNPhNcWpTWWnhFtwsOuKowe7UzJjDsrh8J9kw+MeySn5VAhLCnG7KTLF8JgsI4WtZscMhAoJt/U/YcJzoKfij+FEwjFxd7I3VoyL00k48J9lZx4/p4UakVhjKbLHBWhg+E0+CuAiWIY/CblPS0qUWVwomUaaVuMVm9QJMraN2Vs8KEDTImnmljpGiTNYLsWt5COnFjr2Uq8VGkc3DxHyPPA2Cwczn5GU/pBNlbDXGSTxsbGPT3AUfSNIPndTx/hYdVVi6PJJ0207rS4WF5c0UA4DlbjGZC0bCwndMxHGYzPH4VlcfJ1nK7Y2o2grkgSgUl90j5Pd26g5Y/a33VLkH0u2V3luqLZUuV6Y3FajGPONQIOZIRzajtA6gnMw/wAVJXummH1e66SPRH0x+n7OnRsb/wAQW1WR8Bs6dExyf/ZatcuPk+vV4/gQhCw7BCEIBCEIBCEIBCEIBCEIBCEIBCEIM9SQQl2Um163kIOxSClu3SFEIKbKWkGlA04JCccdk2jJ2Hgp4FMwcJ4IFItcXQglYf8AqBSva9Ko8NtTjdXg+1c+3TiEJuUehPUE1KPQVJUqA5NlOuTZGy7MPJvH4I1smti1Yl5Xov6h4jhPHkAekil51IKUd+DJaSpELQ1t0m2Cyn9milHWQkD1KfCKaoLRup8LXFnCxXXiYkxEDlSmOb3UGnN3rZNOyi2xwVMdFoQ0n3CjSxUNgo+Pmng8KZ5gexTBAlZaZMRUxwSaCuJYiiIp6KPdOdKdjYoYlY7R7KfG3alDgFKax1KK6WN9kxIzvWyfLgm3u9NKxm+ldKAwKpzX/tuKtM13sqTKcDG4ErcjnVUGn6hrro2tyx5+jjJPZYkM6pWjmytw2MOxmNHspYeOmNz2tT8P4ATUTQORatsCFpbdBZXydTmacZih4sqY2MRt6QlAAcBc3u0kfP8AJ5b1fRdUuSHbhKZskyu2Vx56rswftqmyzcElK6zD6aVJl7QSUrB5plX9VIkw/fVJ3KoZEh53XMYdUzR7ldeXaPp7wSCNGg/8LFqlmvBra0eH/wATP/paVcPJ9erxfAhCFh2CEIQCEIQCEIQCEIQCEIQCEIQCEIQZy0lC4vW8ZNpJKUklQISCEon4SSoGr23TZKW4Jsoydx3blSAo2ON3KVSAC6uDfjZCCVik+c21fD7VQY7gZ2bK/bwsdunDiaf9pTqbdwsRKglMkp8hNlq765sz4xwTm6M8tbbmGwvFp2lpcKojsvofJhE0L4jw7ZeH+JdPdgatJFWxO34UdfHVRA0ldfdrsLunkLvUx7uf7KO8pcDC94C0GLg20XsFT4YAlDuyvpcoMh+4BYrtKTNBG1hAIVRLjCR+yi6hrQxjd2FWw+KYTJuxGv1F8zDDW2BulMPQCDsncPU8fKj2oFQc/Ia2Wmbosp/rsrqiRTdSlAoaW0XypEbd1HaaUiMqYakx+lOeYmQ5Ic+uFMNSDL8pD5h7qM6Whyo0mQrI52jKksFUOQ49VE2rGeUlvO6qnk+Yb3XSRyrsALZ2ErYxSh0bQN1kYhcjQVodPcS6rWbGuKtGihsrnSwHYgcFUAbK30j04VLDj/U/PScgLtLndHh0o8JEo2TlWE0+1pELLb+3aocwnyJPwr3NpsfKoc51Y0prskHnGRfnP33tLwd8uNvfq5TE7rnee6kacLz4B7vC6x15r6j8IitJi/8AgxaJUPhVtaVH/wDBqvl5/J/k9ni+BCELLqEIQgEIQgEIQgEIQgEIQgEIQgEIQgzSFwFDjQXqeMlISkhBwlIdxtylnlNk0bUTTJKbJTppNkKIXAfWVKUSA+tSgUCuF1cQqJGLtOxaBnCz2O6pmbLQs4WO3ThxIPBS0grELEIhIJTh5TRXZy024XsvOP1E049Lcxo42JXo5We8X4rcnw/kXuWtJCYcvFDbVXZMxx5+q9lMychrCdwK7LMalmmWUhrvSrj0StHjavHQHXSkZGoh8R/c/wArEtPTuHbpwzuquo0pjc6qyysvzhVWFBijjc/590wJPlda8jgpifpd4+R9O6mSbKXHO55susrPwuJfyrKCagN6KY1O1/jvobqexwPJVFHk9KmQ5jTseVnG50tuoJ6J9qDHKH91IicstypnV8pqR9Bc6/lMTSghJ7LcJkl2q90xI702So7pCZOUmWTtey1I5WuOJPKh0fMUl76qgmiD1ErSBn89XunPPXVf3VE2uuxytHprD0NdzazavK2a3ZXGngNx6HCq2NVthNIhXNy/qEtJvfhBtd6keApIfylhNyFXUQM4iq7Kg1LbDlPwr3OI23VDqf8AoZ/wrFebzbveVJ0odWqYwHaQKJISZHdlO0UXrGNXeQLry6cvqTwxY0tl/wC0K8VN4bbWmMVyvP39e7x/AhCFl0CEIQCEIQCEIQCEIQCEIQCEIQCEIQZ1se3CTKADSktaVHyB6l63kMpBpLTZURwlNEpZKQoybdSRaU9NlRDkH3qRajQmnqUKRSgV0Li6FRJgoSs91fs4WdgP7rCeVomcLHbp464kkJSQsQqE/ZxTadeNymiuzibN2qXxRkR43h/MdJQBjIV2bWI/Ukynw5KGXR5Wllx8/alnOkypAwmrNKrayR5BcCbVi3FL5Xbb2rODS+potHbms9u3sUOO2+xWlfo5I2AQ3RrNkD/hTXSe1BFjSO/pKdOJIAaaVrcbSmN5op86XGe4Ca1+WOiheHbAqR0vG5aQtONKDRYpNv04Fp2sJqfmqSIuDqT8b3NkvspTsMMN2kFgaeFCSpEU5aatXGM/qZfdUcY/cBIV7ht/ZsLONw49/Qy+6gSz2KvdP5TyGcqqcSXE3srIlpxriZCb2XT600NuEtr/AHVxHZDxaJG9DbvZNvcXOpLfZaGndEEERctPpzXR4zfdUuHH1dloINmV2WLW+U2N1hXWIf2d1RMKvcRpMI33WZHHzpBqkhKcCBwuUmPBSk0+73TqbebKiK7N+VQ6u4MwZjW1K/zm+qrVBrO+nTV2C1CV5vJXmFWOgtLtawwP/daq6T+YVa+GhfiDD/8AK1deY68vqPw+K01itVW6IK06NWS8/f17vH8CEIWXQIQhAIQhAIQhAIQhAIQhAIQhAIQhBVCM+6hZO0itAzZVWUf3Ta9U6eRHLkldpJJRCU2SnCm1lk25NlLJSEBGT1qYFDj+/dSwUDgXQuLoVDsR/catGzhZuIU8LRxn0BY7b4dTZS0khYi1Df8AcU0QnZPvKbK7OOGyVnfFmGc3RZY/haMhRcmETQOaRYPK0PmPLx3Yma9m2x4UiLKDRu00tB400r6bW3Pa2mO70qlsDXNoUo7cHcecOb8/KcDweCmTiH+nZAheO6mPRzDzMgNKU7JH5UcY7ieVMhwOso2ijJd+QgZrwK6TSt2aaGt3ASXafGOwUTFJI98g9LCm2xPvcK7fGxg2aFG6K7IiHHCSeFc4oazHIUCw1LhmtpFqprmWbFKCWV3UueQOUUiwkiUkDYpB5TgcAaSS02qzoZZcCeFKDO45TDG0pkW5AUWe03Fi9F8FWUTr4UCDcVwFNh2XOu/MS2Gud1odJczJLWseD7rOX0tJU/QNUgil6ap1q8xw801q8jELWXSrT1NJBWkxpI9Sx6jILwqrOxHRvJ491bHh65xC7Jp/KepMuvqWLHKxW5xPWs9rTyNOmruN1oc6utZ7XD/22X3pXlI88du61d+FWdXiHE/8gVKRRNDdXvg5hd4lxR26rXaV25fT+jNrTo1YKDpP/wDHRqcvN19e/wAfwIQhZbCEIQCEIQCEIQCEIQCEIQCEIQCEIQRiKGypMs3M5XrtmFZ/IP7z6Xfl5KZJSUIW0JTZNJwppyyybKQSU5smjwgVHu9TAN1AY71Kc0qhxdC4hA6z7wtHF/LCzTCepaOE3E38LHbfH+iikJZSFiL0iSfcU2nJB6ikFdo5GymTvynimiFUYnx3oozNOfMxvrbxS8fZOYpXMdtRX0Zmw+djPYRdr5/8Y6W/R9QOx6XI1zcOx5LCBuEsOYTuVmoJnEbOKTLlzxO+9V6OemraWe9KVDnRQ8uBWGGZkO/r/wAp6N0rt3ONLON/utbLrbBs3dcizTMNzus5DCS67VxjUzfuo3OosJBShZEoYD7p5+S091VT5Ae+griWky5QBKcxJuphJVfMPXVKRE/yoqVxz1Lc61xm7UyJLbYKIJTuCqmlFpL6T/SPZcaBd90v+6gAK4T8QTLB1KWxgHAWbWuUmIqdGoMYN/CmxHbdYr0T0dleBG48LETazNi5zy0nY7UtTqWUIsdy88nk68h1Xbjst8e3DyPef0k1CTWcfImcCA3i1vtUwGyYjpGjcrLfpFpLtP8ABzciRvTJPvv7LesaZsJrX7EtsrHXV/Tj+NecSsMbyCKUcg9XKuNXx/LnI4VPQs2ljx9TKrMwfuLOa6R/06RaTNrzFmtfbWmyJGI8/NtfYWl8EAO8T4oWdpaTwK2/FOOfYFdY7cvpnSRWnx/hTVE0wfwEf/xUtefr69/j+BCELLYQhCAQhCAQhCAQhCAQhCAQhCAQhCBh/wBhWcnNTOWjf9hWcyB+6V34eSmV21xC2hJKaJSjdpJq1GTZSClpCiOtCmM43UFpPVRUtpJRTwK6kApQKoXHytHjbwM/CzbCtHin+Hj/AAsdt8fTjgkJxybWIvaLIfUU0npR6tkyV2jlSU24UnCkOo8qsmyvKv1V0502PHMxt9PNBeqrP+KNOZm6c9rqsIR82wShgI4IRK/rdZOyk61pz8DUJAQQFVvcTyVZXWVIc7p7BPsm6m1SrfMPunGSkG7TG/0vIZi0jdT45w3hyzrZS6yDVKVFkgclTG50tHZBL67KK+SpbKa865LB2Q99v91S0+5/WbI3XS8kVeyZEm3suCS1cTUhrqFJyEEuu6UeO3k+ydEobsFCVMbKGjdcY8vKigueaU6CMjsprUiRAyzupkbU1CwgWpApqzY6w80UKXXTCNpN7Joyho3KqNTzxDGWg2VmRvcRta1HzAWN3S/A/hmbxFrkTQw+S37iQq3TdOydazWsjaSCdyvo/wDT/wALs8P6O0vaPNf370tb+eXDu7WhZDHpmlw4cVCgGNAU9oDWgDgClBlaMnPa3+mD1f3U4Gx8rjfhLGf13D65Q9o3IWPljLJXNIpehStbPqBjO4Yzf8rK6zhGGd7q2W5Xk8vHvYx+Z95Wb8RmtLkK0uYLkPZZfxJvpjwkjzyMKtR4A9XiuAV2csutb+novxVCa4a5dZHbmPpTTtsKMD/apSjYArDjHwpK8/X17uPgQhCy2EIQgEIQgEIQgEIQgEIQgEIQgEIQgjvPoKzuSf4h4WhePSVnMo/vvXfh5KaQCkh26LK2jjimyluCaNqMuFNpwpkkqIUKJtS4+FBBUyN3pRToKUEkJQVCmlaLC3xmWs6FocE3isWO2+PqQU2U4eE2sRe0aT700QnZb6k0V2jlSEiglpJVZNFp91X6m0OxztzyrEqDqLf4c7po8n8XeH/qGPmjbZ+F5ZPhzMMlN44X0LLE2UEO3BWZzfCEWQyQxfcfhIvNeKdJA3u0NJ91s9S8JzQy9Ias3kYP08pab/C26mWEBtEpf9VWmywtdwkdZa5TG4nMkIT0brduVWea4nYp+CVwNuCipZkBkLEpuyjMPr6inw8E7Ba1J7TGvAbQ5RGC51pptKTBQKxrciZDHfIVnEyh7KHCQ3lOTZVDY0pjUSzK1goHdIM4rlVD8ynJmTN6R9yRqVYZecI2mjuqrGxp9VyxG0WCUwxs2oZIjjGx9l6x4E8KeSRPMAT7EK8xzvbSeAvBUeDiMnmYOv5C2+dnM0nG9fAFNT+KWRwho2AVTlM/6vqbYCP2oXb+y533ffxnfSfowf8ASGaX+ZKeohWDvcKHHeKRGSSwbWnMrJbj4kkxr0t2/KzZ72LEXS5hk5mbKDbQ4NH/ABv/AJSdZwxNAXAb907pUHkYLXAep5L3fJJtPZkjfo5Ddj2T/wBemOpsx5rm4DnElo3WI8VRPi094IXsjcVs8V1RWF8ZaL14hb2K7fl5/wAPFgTa2f6cgu8SNIHDSqDI0aSCQ0dlqv06xpItfLiCKHstY1I+hsQVjR/hSEzjbY0f4Ty8l+vZx8CEIUbCEIQCEIQCEIQCEIQCEIQCEIQCEIQR3fYVmcsnz3rSPJDSszkm5nrvw8hi0olJQto6SbSTSCbSSoySSmk6aTRUQbWpMZFKKpMQ9CCQ1KTbSlqqWFf6cf4RqoAr3Tf9KPysdtcfUw8JtOkJsrEb7iNKfUmSnph6kyV2nxxpBTRJTpTZCs9oSVX6iQYatTpHBos7KizclxfQbYTCe0dsTe4pdkjZD63OAtcjc8W9zCq/VXvmi6ozVcKyNzlD1h2OInve0E9ivLtShZJlGVrfSeFp87LyM2b6d1taDu5VGsxta1rWAABaakZbIhAdsNlBki32CuZGBzTtuoMsRa74U1uRBMdHZPWaqk4WD2XFGnBadjdSbCWAsrElr/ZSIX78UoLTXCUJCO6Yq4dkAD7lDmy77qE7II4KjuntWLUl05PJSYmS5koYxppdxMeTMmaxjSbXo/hvwm7qY+UAA9iFqRj9JfgfwkABkTNHwCF6vi6QIIeqM9LvhQ9GxGQMAAAA4WgdKyKEudQCnX/GFJm6v9JC6J1CY8D3VlocJhxeuTeSQ261SMxWaxqjsn+iL7T8q8ilMP7cgocWp1P7cgs3ta9u+6zesSyHNx9NFlshtzh2CuTlBkZcSKA5VZpbBn5c2a4WD6WX2CxzLz7rWryH0Qta0bAUqrXnGLDpjqLjVKW57sd5b/SFTazK7IyI4Wb9Bspzz71mq/Cz5IZvKnsKZkxY2pRdDnAqDl4PmQOd1eoLml5cbfSRRHNrvjKoz/CcRcejpPykeG9EOn6hI9zOe62jzHLEdhZUFsgjeGuqz3UGsgIMTQOAnVV6dkeYC09laDfuvJ3Md+L6CEIWXSBCEIBCEIBCEIBCEIBCEIBCEIBCEIIk1CMlZeZx81+602Sf2nLLSOt7l6OXkJQk2V0Fa1nRXsk2l8BJIUQ0SkpZb7lIKiEqXH9iiqRESWBA+EsJsFOCkUsK70t14p+CqRXGkf6dw+VOvjXP1Zdk2U4eE2VzldO4YnCjlSJ1HK7T44Ugpt1USNk4o+Q/oiNlWJIqMvNMsjoo+B3UVsjXPDRx3TeTGQ53lGnO7lRC6TGPq57lax0kSs7MZEzymuBcVnNTzqa2GP1Od2CjavO/Fc6cEuLuyhaU4y5RyZ66hw0qtSLFunMZiEPovdy5Y3V4HxzEX1NC3E84c2gdlkdeeGR+7ihGZeKJUV5Uwg9+VDkCy3PaM8+yRSU5tFBPwprWOUhJspVhRY71JPVaSuA2rE0lxJPCXj478mUNaDSdx4HZEwYxpJW50Tw8GRtfIKKRmrHwX4ZtommadvheoY2kMeQdxXFKFoOB9Jji/wCrgey1OO0Nba2yghjsE27dnv7Ku1XVfNEeNjnqc8712VrquTHBiP6yN/8AKodG0qSJzs14LrNgFWf9Go03GZiYTIwB1VZUmSNsrD7qDDkh3Gx+U7Nltggc9xAXO81NZzWs2eHIGBG0uD+XDsFodMDMXEjjbwBdKo0yA5k8mZK2+oULU13XiyWN41uzZlNWsz2uicXVQHKy+DOZcmeQu6m9XpPwndf1duFpMha71uFALL6NnSQQOa/cJzzhrVvc0k78rOZjnYWaHAeiQrsOtMmyzE2y5o3A91MyIH5sH20RwtaiXjZ4EbS40VYQ+XM4PICyhDsQXMSaPKnxatG1vSDZ9gmDVRSthkPTspsGcHbHYrIDPnePSOke5VZlZmTjZkZMzuh54WbxKu16g2RrtwbCVsfdZDB1Jzo/5h/5Vl9fKWehxJXC+JueSr5CrMTUnva1s7affburNcrMdeetCEIUaCEIQCEIQCEIQCEIQCEIQV+W6oH0FlXk9S1Gaax3lZVxtxXo5eN3bsgcpIKUqmO2uE2hcJ6VEJcLTZKWSkIjifgPpTCehQSAE4EgJYRSwVcaQf2XKmVxpB9Dwp18a5WnZNlOdk2Vzjp1TMw2UYqTNwox4XXlw6IVJq+a2Fwju7V07YErNZkQyswv7BbkIRG5oaJH1Y91UatqMLGEdVu/+1ImimllMcbvQFWZmkOychrgPt/p91p0iuhxpNRkbJKC2L2Klz6cwt6otin3S/TtIkb0gJD81gisOH4VXVNlzHEjJkWdmec/I6n7RN91pJMWXVZC0tLY/f3Cg6rpH0MRdGC6lFZrPjEbgWjZVbhfKs8uVz4rLaIVYSsVqRHexJLU+d+UilG0fpC4QpVCuFHcEwMFxS4InyShrQSlxROmeGNBcVu/DfhSRzBkTAMHyrGb6J8O6D5TRPK0X2BXomh6OMlvmvHor00qrBxPqdTbjx26NvJ7L0LBx2RRNawANHYLpGKisxpcbei5isIspojJvj3UqgG1ssx4hL+pkWISJH/cAg55p1nUwxp/Zjdv7FadjGtjDRQaNgFn9LhZhQdFdMjvuPurmOYEblA3kY+xkiNOHZZzM1GTUctunx231U/5V3quoNxMVxG7j2HdQNM064TlP/nPNg+yuJi6xw2GFkY2ASnkFp6hsFAZO5juiXY+6h6xqf0mGQD63mmgFMRkfEUj83V/JZIfJYePlMzQ5GPi/tkFTBjXJbh6rslSxitkIDnAt70miF4biGPbpYndTjZcVosvNZi4peT/AGTAljijqqDdlQ5uW7PyPJjNtHKgml0mdCW8NIu1E0aMNfIx1lzHVZVhhgFoZdUo+OfI1WSJw2PqtaF2xvUoOrY9wNeBZapzZWsBLj+F0Fs7SCNigjYQJga66taXSA149R3VOcDoxgYzsOAn9N1BrHBjdnd1izRpn4zH5LC2/R7Kcx3U21V4eQHue+9z8qdjP6mbrzd8104uJCEIXN3CEIQCEIQCEIQCEIQCEIQVeoV9K8LKuoONLUah/pXUsu8Ufcr0x43ANuUoEpoJYOyBaFyygkqMklNpZKT0/KITZT8J91HIIHynotxXdBKBTjflNjhKBtFLVxo52kCpwrXR3euRTr4vNXCbKWOEkhc460zN9qilSpvsUUrrxXCxHyX+XjvceAFmGZQdEXNNly0mc0uw5W3ysr9F0dNO+0LcJElpbDFdizymgSWlxFeyhgyulPXfQ3/KU/KbIQxhsjkLToiao0S4h26nE7LOt02aKdrsguEZ/wALYMa10tGiGC09Niw5cBY7g8KiBhMjEYAFAbBVviItbiPtJy536VP5Z9TD3B4TMjHativc80OwCi68vzcsfUGO+SmjXumNaaMfXDE3+kpLn+xWbHSHi6lxIjLpDtup0GnzzH7VnGtRHkhu1lMiOSQgBu612D4amyGgBhB+VfYfhONlOkcKHelrHPVT4N8MyZOQJZR6fkL0DVYBBgsxYD+448eyk6dBBp2EXBw6R3Ce0nG+uznZsotg+wLcSl6TpUumRdR9Tn/cVosOZvTXB+U/CwdBscprLxQ1jpIzTgOECc/NZi45e5wsD/KrtGgdlTOzZhf+0FUUmVLrOd9MGlscbtz7rXYpbHG2NuzVcHM3DbK0uZ6Xe6qZM/6EEZHp+VfPcC272WQ8Qn/qGSMNotxO9JgIZ3axqgdV48f+VqWFrWADYAUFnMPCdpMbWiyytyrSLJ6+DY9lRJyWsexxdsQOVjeqXM1hzpD1Y8J9JHurrWM/ohETDb3mqCjMZHgYzYT/ADDufkoycMbHA2Buq7JZ5YcY3UPZLkzxvZVTk5jp5vKjN/hTBGydSkkjdCLDypOlwmOIuO5PJSxpzC23EF3up+JihrensoH8aMh4euZGO6SfzminVVqa2KOCO7NrkLTkOJqmDuO6urhqBnXVgmu6so3xRtsik4zy4mEBo3UbJl6z0tbfwmmJHnNe3Y+lR34b/MM0LXA91Kxcby2dbhup8bhRHAPKYiPppe6nF3HIV8xz2t2KzbZji6kY2j0O4Kt4snqNBZ650ieM0jZ4op+PLjePuAKrJCdngX7plsjS7miud8Urc6saGx2Qqlk8jRsd09BqIkkMb9nD/K5Xx2N/tYIXA4O3G66ubpAhCEUIQhAIQhBUagaxXLKveeqwtVqO+I9ZMk2vTHjcBKU202ClNcb5QPIXAUWoySkWlJJARHL3tOwn1Jkp2E7lBJBPZONO26balg2EDgKs9INSuHuqtpVlpW2QVKsXg+1IJSxwkkLnHa/DM32KKpUv8s2ou3Yrry4omb/p3nss46YNbIe9UFo83/SvWTmjfG897ctkSntazF43IUOPBbG0yE+opzzzLktjGwbynifNnEY4byVptEZBLEwm+ov5TM2Y+KQMDT6RurcEF+x2aowhbI2WRwG6Csiw25wc+ch19vZV8sb9Me9h/l9lZwyeQJZR9gKRqLosrTS4nYjYoPE/FbQzXHSAfdwkYeDNmOHQ3ZXuVoUuq6uwCNziD29lv9I8OYulwDzg10p4HspjUZrw/wCD3TjrkYWj5C1MWiYmFE4inOHurLLzY8LDIa5rXfCx+frb3dTGvJPuFcXU6XVoMDJc2R3pDdq91U53iWXIPlQ0xh9lRZjn5MoFkjumnQlou6CM60UOvTPx48J76ic7d19l6doGZjSY0ccMg24XiDGSncAlanwtmz42SInvLTe1rWGva43Dp2KrtZzfJx/Kj3lk4pRYNVZHjudOelw7+6haTI7VtVflyA+VGfSCmGrHC0dsOC27Ex5cuGSTGd0SA17q62Nb8KLlRMfGeuqARVbn6ozFwnPsEjj8qHo2JbPrJd5JDdlUk0E2bqz2hxdixuWohkb5TejbpFUqJTmtc2nUQqTUg7BifPCbDeytuvYlUOpTnMy24cfBO5CCv05zs7OOVOekNFhpTGpzTz5pkidYHa1b6hjQ4mHGxnpf7hQI42tYXuvjdGWd1DNfCyn2HnhS9Fx3iLz5N3O4vskPxhq2p7D9uNXMeF5IawO2HZB0Av2FEqyjuCKywlLxYI4R1EC07JIXDpaFkRmOflOLQ0gKcI3QxNAAHwERNZBGSTv3KrxqJyMlzIjYaUaTGvmeSOi/lSYMZzP3HC3JGPII20TZUgTCtkC5JxHGS/ZQW6iHl3Sb9gmtQyjLKMeIdRd7Kww9JbFG2Sh19wrrJny5pYw9zQ0jhTcNrnBvqAPdOO9PpcKTIlEcttICauLNscgb93KhTY8jMgSB3p7oiz+u+6cOR1sIPBUU/AXOkNOsBOS45eesCnDuqzTnPiyH7+g8K3dMOjZS6G4M58IDZCNyriOQPaCszM76gt6diFZxZhbQLVz74341OsWyE1BMJW3SdXmsx2l2BCEIoQhCCnzzWK9ZIk2VrNQ/0j1kSd16Y8btLo+5I6t0tvyVE08Fwhca60WUQlcJXSkE7IjichouTaVDs/ZBNCUkBw9ksFAtoVjpRP1VfCrWndWOmGswUixfhIJSwkFcnW/EfKcW47iBuoEcg6B1mipme/ycGV9X0jhYjHk1PUMwENLIr5XXlyabOcPpnb0FSgBxLjuFa6mw/RUDus+2csicxxp17LcI79M0iSYbEqMzzcWN0jmklysS8CMR7WV2RokIYd2jstNoLMkRw24gPcnpngYXSPuK7Jisnm2odKr8pzseR73C2RjhA9k4YOmGAH1O5+VDi04vgZG6wwdiq7F8RnOY4shIAOyel1SV0IABZaB+aTB0p7pDXWBQoLLZ2r5mblF8RLG9qTmcXZWVDG4kgmypbcdrWU1gKrTO5Lst0ZdK8n8lV+NE+Rxe80CtHnxebPFisbu/n4Cnt0mMRBu23wgoI8YAekAlRsxgMzIGj1OP+FfZWCcZhkY7ZU2HDLLlnJlb8AoynQ4jIowByuvZ5X7g2Le6lN6Sd1B1SYRxNiZu9x3Whd4usu1jT2YPSfNLwOoey3unwO0/FjZ020CyQvM9MiOB5cjB6wb/ALr0fR9UjzoAxxHV7ILePIB7qu13UPJxhDF/NfwE7ksONG6WM2wC6Wd06V2s6z9S8ERRcD5Rpf6TgNxsP1bvf9x90ZWKWB0sP/CmslHSPhD3N6S4nbupoy2oax9LAWuoSHgLvh+IiI5Mx9bzdnsoWTiDXNfkdHtFD37EqbJJLgkQllgik0RNUyjPndBvoaqzUM8CPyICS9ytMl0ePiullA6ncKq0zS/qJn5bi4XxaqYm6dB9LjAO+93J91YRgOf1kGkmDHc6YNedgpuRkRYkLQ6hZr8qahPmlzfQ209DE5rep3K7DJGIxZAKblyQXV1bKLiBr0xxtMnk6yD237qq8O4uTBpjJSS58tOs+yb8UZDn40cDdzLJVe60en4xgw4ojv0tr+yKYbkSs/mMITzckFppxtSpmtbEXPAH5UbAwW5EhffpKB7R8UiY5EvPa1ponAM5VSIX4/yAnmT2KtExPlLSzelmdYdJCP2XGyr3r6mcqq1WK2idp2byEUafHKYQa9R7q0jgcfuNqtwMhpaN1Z/UDsgjlhx8geo9JVlAS7bkKBO4yxkAbhGmTuL3NkPqH+UFwMMtHW0KPM14kFDdXEPqjB5UTOPlPa8N2vdcp3bcXEvFaWxC+U+kxkFgI4Sv7rz2+3bn4EIQo1AhCEFPqI/hH7rIFavUzWI9ZJ7hey9OPG53XUgEpYUZOMJCcTNrt2PYoFpHbdKJSOURy90uL70ivlKiNOQSwUsfCbBTjUC2D3VhptfWNVeCp2mH+LYixogVwhdCHLk634YnaHxFpFg8qE2NkYprQB+FOf8Aaob105cqgakaiCz08HnZLWtNEclXWqyOETK333VVDKLmmJ2BoLpCID5JRntDgehg3UyLIa5rn3zwlNhLoiSLMnJ+ExlYjh0sjNX7LTaS14GMX8OdwqjXZPJ0ieQn1EUE+/JcJBG4Gmcqn1XMbqOVBhRuHS02/wD/AMVBounGLAjBZ6qsqTLpxLSTsAFcYTWiCq4UXWMhuPp0rgdyKH5QZnGxJHyvmHqa00FLaQ1pLh0kdlZ6dB5WDG0jerKa1eOJmnyPdz2/KNKLTx9Rqs2Sd2tNBXfQ0jhQtM01+PgRubu57bP5Up04gY4yjpDeSgrdT6pciPFjFl3PwFOjwoooRF0hV+ku+qy5s1xsONN+Fd2rjKsn01rWOe09IAWWjilyNUfK6nRxn0rWa1knH094G73imhMaXgeRggOaOp3JKorfN6u9KXg6i/ByWyNPpHKdysJjm/aQfgKg1QTYsNCiXHhFx6DL4jjy9KHkPBc8htBXWDpTcbT2NiPS6rNLyzQP4MsMoJN2Qfder6XqEeVjNcxw+QimxO+J/RKCPlRdX1NuJp5PUC93Fe6t8mJkkZLufdYWSCbM114JL8eJ2w7LI0ehYYxsFpO8khtxUPVJw/N6AQC1WLcmNkJ6TVcBZnWaGPLIDUjuN0ETLnOoajHiR2Y28laKONrImsbsPZUGiYGRiQtlcOp8nutXBD0s6nq6GYwI2EkEkrKajqD8rxLHimNxih3c0e62U0gYw7rF6XJ9R4g1HI5HAKiYuXag0N+0gqOMkPfs/ZPuia87tC79DGI3PdsAEVUSRHN16Bl3HCbP5Wvif0qj0nTntjkyRu557+ynZE78THdLIKDQSUDGpZv1GoRYMbt3H1V2C02FG2BjGNAAWD8Mk5moz6hLy400HsttHN0uG/CCxfVUoMjWPeQPT+Et0/TG5zv7LL4mqyOzJmSmi11AINSZGsbVpieXzYnNIG/KimUystlkp2PGkefU7ZBRYmQ7HndE93B2Wix3SPZbWUVU6hisxslk3TYPKusCZro1A+2CRw3oJl+K6HIY/r2J3U4OA7hJm6JIHVu5UXWAXeVR3S8thfC4AKJpWR1xb891akA3fdebq503z7R8KTrg32KcyLERcDuuwtDWVSU9vWwtWLZutyXBE/rja73SlGwy4RdLhuCpKi86EIQo0oNXdWG5ZAlbDVW9WEVjnil6teR1pS7Kaa5LBWWcOCiUvvabad+EsFEdspNlF7riAQw2+uy4SuxbPU1E1KBKQCUoKhYKnaaf4tnZQgNlM0//AFcdIrTNQ5DUklcnXfRt/wBqr5X1dKwf9pVNkSdJO66cuVV2rO6oed1SAujEcD6Fm3H3VllSCWQMXDCyaVzyBTdgukIXDK0itvZdi6ZJXOO4aqx4kx2uewkt7BPwTeVh0R638rbaSyKJsMs72g2SSfhZrSNMZlzZGUBXXISCrzUMhuNo0wPIjr+654fjEeDED7A/8q4OSYU+JEXtcXAdllsnUP8AqGpMxCKEbrcOy3OrZLMTTZZHe2w+VlNN01nQ7JmaBLKbJUFmx46ABVBVurn6maDDH9Zt34Uk4skQJY4keygY8pfnyzyVsehtq4ur1kYa1tbACqVR4kLWaTI0AF8hpoVmJx5Yoqm1Cs3WMXGv0x+pwTDRgaWcbCjYw8C046R8R/caVcgUKHCiag6OLEkkfVNb/lVGXyMgalrEULXDy493LQCukAcBVGj6QTDLk3T5HbH4U53mwEh7SW+6Lhx4buSs46I6jrAY0gxRlWeo57MfDkf1DqA2HykaBD5eI6V4HXIbtTTT78KMiqop3TpptLmsOLo+4UotLrNC1W6rN9PhPd3I2Hyqa1uRrLH6PLMx24FCvdL0LBGLp4L95JPuJWM0aGU4LY5XnoceogrfQ5Dfpm1Syqs1ZkcMjS11E8qhDHZ+ZX/pM5tT9RfJkZpDQSOyVkxN03Qp5Bs7o6r9ygVgyCWd3S4dDDQU9+UQKoKk0fDczSYnGQh7h1H5KcnZkNHocCgczs8RQSPduAFmvDMtwzTkfzXWu67NlQ6ZKHVbvSPyu6JDNBp8QczauUGihcHHdOZ7qxRGP/VcGA2okEu9OFfKSZDPqmNFdtZ+4R7FBoMaMQwsYNq2VX4kmLNLdG3d8pDQPyrHzxVdlRZrhneI8PEafSz1uCuC60rSI8fTIWV0u6bP5Tr8eWFzi09QCsw39ob8CgkOAMZF1agqGZUkza6d1U5WF5OpxTSekSdvlaRkLInWKtQdaxvNxfMb9zNx8IJ+IWuiFAKYKaKKptKyW+SOo3Q4+VOfk3xYQJ1FrZMZ7bo1sqvStRPqZ3BVg5/WPdUb8OWDOsHpa7lBqhI12/WCE7BM3r6emwVHwsdhjAJsqzx42NeKaNuED2CBDMQQaKvWmwoxjYI2vIAUgCh6V5O7t108cwNFJSOyFl0z0bYAJXhOKM4lmWLOzgpANi0v+2eb7x1CEKNqXUReI+1i5aJK2mof6V6xMhqQhel5Cf7roKb/AClB+/CjOpLeLKXtSaBKWEQLi6uIOA3ylMrqSQKSmjdZRKBTgTTeOU4CtBwFTtPoZTDSgtVhp389qK0IK6QuBKK5On8GX/a5Z3NeGylq0R4csvnEHKfZXXiOaqcXR5jnHcAbflSA8HH2O7ksxCRhB+47qC8Ohno7saF0xZD+Q9jJosat3HcfCRNimfKYxm3TyoOl5IztRycs/aw0y1d6b+8XT+61GmV8UHLijZjij5z/APCttMyDBCxjwR0qNqBGb4rjjH2QNs/lXoxI3xgVuVoVOsy/Vz4uG020nqf+E65vTVAUNgor8SVupzSMFtaOivhdllLdiaUwOzythxZJT2Cbiwmv06IFo6yNyq/PyWyCLF6vVM/pI+FfxgeUADsOFRTSwS40ZcDbR2VXoT3ZGXkZ0wLTw0H2VnrWQ8OZixi3ymtuylYuAyLEbFQB7oHGyA/1Kn16Uvjhwozb5Xf8BTpcWSC3NdbVnsSV2Zr75pRUcQpo+UGnx4hBA2MdhSW5rXN3AKRHKHd13ImZDA6R1ABF1ldXwm5+rxYsew5dSsWwT4wawgEDZd0KB0skmY8ep7vST7K9MV8gKYioa8UbcB72qTLd9fqkeM3eMbuWg1SCMYznfa93Fe6haRpEuOzz3Dqc/wB1RPix2siDeANgn4ch8TugWW+yTPMYY2h0Z6nGglRO8kdb4ystLPHhZG3zH11dlnvGWZ/26KBp3fJVDup0mpRG2k04cLJ+IMoZOsYELXggmz+UGrjLYsWNo4Ddk2ZOrlQTlhrQOobJoT3/AFBBA8SO8w42MDvI+6Wnw4B5DBQFBZHIc7I8S4jORH6iFs4HACkDjsaNzDbRt3VXgYTnzT5LL3PpVln5DYMCR97kUPynMFnl4UYrerKCE50sZAc0/Kq9Glbl+JsrJ48pvQAtJOWiB5I4aSqXwtgNkxZ8vh0spNq6NR55DaBTP1XXMWXwmXwzRE0C4KrL3xaiRJsHcKC/va01OWGJzXbg8qO/MDWbHdMF7sgUzdBRY2Y/Gz5YDuOq2rS4sLp2hzyQFT52I3EyGZBbZuiVd4OQwxtooJ8ULYxsBai6nA10IlHLVJZILtJyJmGJzNjaBvTckOA3Gys2ZLWu2KxcORJh5sjJHANP2q/xJHzsBa0koNVLleZgt6DurCJ5dG0k7lUOA2fo6HAdPsrmJ3TG0FcO+Z/DXNPyP6InOvgJQNtBCr82YjHkDU/gT+diMde5XK82TW+etJzutphe3c9VH8KSy+miouoPDImO/wDzCmNotB7JfhPuuoQhYdFJqJ/hZCsRJ95K2mpOP0Ug7rEvcvU8hN2V0FIv3SgVGD4JToKZbdg1snLKBf8AdJtcK4g6SVwON8oO65SmImM+0J4JhhtieBVDjSrPTGkzWVVNKu9KZ3RVyEopIQSuTp/Bpx2WR1V3Tkud2vda59UsnqYErpgDv2/K7cMYajeHNdJ27KLqMvk6XK8j1v8AS38nhMyF+NHHAXEdXdJzXty86DG6vSwhzv7cLoqMMZ2k6I6RgtxbZ/KudNyGwaX1kgU291H1OnYzIees9NfCk6xjxweGJJKDT0D/AJVVndBl+pycvOdZMshAP/4rWNlaBzaxmj4k+Ngw+WbtoNX7q4blTRRudIwgDurosomhxlf/AL3Wo+TiRyNLjQTmI/8AhoxW9bprWMg42mSyj79g0fKauMji48uRrcszCXRw7BaWHKA9LgQfZN6TgnGwWdQ9b93H5UqaJr8eRzgLa27VRR4bxmeIciZxtkI6WrQBwcKBWb0TFlhxpZ6vzHl1+4VrFPRskBAnV8xuPC2Not7+Ak6dpjYMQ+a0dbjZPuVWmX63xMGndmO3/K0jHBw5U0V7sN0dmM7eyz2sZkk0jMJrSOp25HstZmTsxsSWZxoNCqtKwvrAM6doHX9o9k1cScGNkGMyNnDeymeaACSmXYTm/wAsqt1DMkxgIegl7uKTUPFn/UdQAv8AaZuflXkcbWsrsqjTWsxscBxIceSpxymgbOBACaK3Ln+r8QR4jPti3d+VYSEdNWstoeWcjVtQyTz19I/Cun5Xyo0TNFG/loWSOIzJ8Tua022If8LSyZTQ1xuqWd0KTzsvNyjyX9IPwguPoY/cp1unRjuU8yjyU9JII8eSS/taSgzemYcsuuZWU022L0LSxSuaae0hQPDMNYU097yyFx+VeljHt43QU+p5BnnxcRvD39Tvwr1krWxtZWw5WbOM6TxKfKNiOMH8K082Rg6Xg/8ACB3U8gRadO4HfpoKR4cg8nRcZp5LQ7+5VDrGQBp5jDhbnALTaeDFgwsJ+1qCwdswm1lvEbywRyxH1NPZX+TlNZjEX6iqKSB2a1wcNigiYEz82av6FoYYWwsAA3VBgg4UzoXDjg/Cv45A9t90DedA3JgLFVYMzo5PJfs5quzxd0s9rXVA8Zcew/qpBficeXbTuuRMlmfYFJnSWefjMmeNiOFbN6WjYUgptU09rWMmJuuVeaM+J0bemlHzKmxnsq9tlUaJmOimdC4UWnZFb6GgpbGg8qhhzwKJOynRajH3cufXNqR3MaY2ubfKTpc/RCGONVwmtTyBJiOfHu4cKrw9QbNC3qIDu4VnP9uU/lca1lNbg202Q7ZWOJlCXGjd7jdZ+dnnYxYy3BWmmbwNY5tVwsdeOSNSrXqFbFdtRyKGzktrnFotcvy3OlPqm2I9Yd9B1Lc6mLxJFg5HAkml2edzrscbpTd03Zu0tpUTD7D6U4DaYYU838ohdriSDsuoguilNPUkoQSY9mp9oUaInp+VIaUDzACVoNLZ0w2Vn8c9UgAC1GI3pxx7qVYlBBXAV1yw6b6Rp39Ebz7cLItkE8rt+XFabOeRjS/hYxp+mkc8k9I/+125ZTXxNllc5wtrQqiCKRmQ+cjqs0D8Kzmk8rBJ/qcKr3RDH5cbWjgLaoD8ps2qQw9mN6z8FPeLM9g8PPivmhShwYxl1PKlj46qH4VZ4wfO2OCEtsPkVF1ow6ooh2DFYagGOjZjgC5DRUTTYnQ4zXHYgUkfUHJ1h23phYGn8ouHiyTGcastHCqNQy/rtVxcEX0h3U8LR9QDCTwqjRsBmoavlZ5BADuhqKs3noh//SgajOMfTppD3FJ3UBIyUhhtqzms5hlEGJ3kfuPhaZXmnReTpkEZP9Av8lOZOO10TiQAQOUuIgMAFUOFG1mfyNKmeHeot2/KDPaLBOJcnLALhI41+FexZIa31bFK0bHEOlQMcPVW6fnxo5BZAWVxSa7lGWGHEYbMrqI+FoMdrWRMiZw1ZR+NI/xJTD1Rw/4Kv4ssD0uBB90VZk+myVR4kjNQ1WaUttkB6Rfuns7POPp8swIPS2woXh9zWaaJCKc93UflExcSRMc3gKn1OIwYU0sbyKarJ0wHdUfiPJMeizEf1U1DFT4cZOzClmDbEryfyrN+RODvESuaMPJ0iBp9lLJs8oqk1HLkiw5Xllen/Kj6AXQ4HUWOPW7qO3KleJHNbpTgPuc4BWukwhmBE0gfYEDceQLFikatkCHSJyHUS2grX6aN/LAqHxJjEsx4GOrzX0R8ILbRP2NKx2n/AGg/3KtA4EXaqofMx8eNjmfa1PtyG+W4g8BA1po69bzpOaAaFcFjSN22qTw68uOTO8/zJjv8BXokCDPa5hsycrCxW+l8khJr4WglhmxYwKLqVPETk+MYg3cQM6j8FamT27IKV/8AEuDTYpSWtDW9ICTNMwZbmBpFcpxgs2DaCv1PHLWsmYNwKKXhZDXCrU/Ia0xOa7dZfDfJFqLsYgm+Pwg0UkgcPSf7KDqWO46bKZRt2CtcfELPXJuUzqdTYb4x7bIG9Oy2nFja2qHCm+eSsto0zw6SIg1Ge6vIchrnEE0gmebQ4tZTLnkxNbDg0hrjytI/IDWny2lxVZl6bkZ9EMLSODSuCbBmlzBZIUtkziNgU3iaPLFjB7yDXurHT8V0oJa2wnoR+nJkYWtLgCq3Fhkx9RLJCaPC17cR44Cq9S06VszZmsJrmlnYLXGkj8vZu6nwvt3FKngJY5o6aB7qyaCACAVO/hE+73qwuiwKSsf1RbjdO0PZeb9OmKHU3VhyUsLJXVS2+rnpwZFhpD6l2xwIJK60m0i0ppUEhqcCYD06HKawcASu2yQ0+67dKjtldsJKENSY6q0+Co8TbUgJBNwI+qXhamNoaxUOkx2+6Wg7Up1WpAF1y4OUOOyy0rtRNYsqzM+OJo2trblaTUt8WRUETw4uN7DhdeYimypHDOigkumesn49lMGS1kbnk7AEpIibkzTvcO/SD8Ks1GCaHFLIyXdW1fC6Ks9GZ04xkP3PeT/ZVniiPzszT4wP/VP/AArLEyGRY0YselvCpcvLGX4mxWWKj3r5UXGnjZcVAUFnsCVzMzMdIDTpKBWnb0iIV7Kpw4Qcd9gG3n/7VVzLzGx4D3XuAP8AlTNHZ9FocMYNySAOcflUOuxvhxY422RJJVK6x5g5rG2NhSB14BduqSPDZqGsyzEeiAU01/UrXKyWwYsspr0jlRdFY6PSY5HbPmPW4rSYHwzQv23aqnW8gTHFxAadK/cfC0gPp2CzeRjtzfFDA11CBt/gqaYuoXBjGt6T6Ut8jWxufewCjOimhLjZcFD1bMbDpUzuotPTt+VFM+Hv3nZeW4fzJCASraeKOXsFWaKPK0qFp5J6irBzxXKDO+KY3w6X5cbzcjg2vhOYk0uPgRNdGdmhN+IZBNlYMAO7n7hW3SGx9JohE1CfmtIs7fCofEmaHYceOD97+Fo5oI3P+0LLa1isk1bEhbexukVdY8obiRtsAgBd80j+pNHAPTs8rowHkfzCgq9el8yTFhG/U/cLTYjuiKNtcClks/Eldr2LCHWWnqWljM0NdTLQWzHCtiqTU+nI1/CiBvpJcQpjJ2jl1Krhk87xdYNiOOkGsYwFtEWFD1GBkeBNK30kN/ypkMgIFqHrsh+mhgYPVK+gPhBF0THlxNMiL22HAO/5Vj5zR1b8d1OZE1sAYBsBQHwqvWII4NMnlDulwbt+UELw3KZtZ1DL/pJ6AVrGyCQi1lvD2HNiaYHObYf6j8lXcM4LwCCEELVT5GeJLPS/kqThvtl8pvV42z4zhy4cFRdAMuRAWuaepp3KCykuX0tJ6kzj4LIdT+ofRcG1ato4GRMut1m5dTvUJ46PpKC/llvhRSzr+7dJikfI0HhP+ZFG31eooKWbHlxmzyxsG4tV+kagJnva9p6wVYa3kzHBkLB0AigueG9Ib9GJZDu/m0F7pkbp2BzGDdajC00NZbwFD06KHGhrqaFIztfw9Mw3SOPXXssd7/Ad1bG8vTZXRgAjhc0LDfBpcfmG3uFkqNFrDNWwgWCg5S250kUQY1g2FBYzrMX0neXIOwXegyDpewUqSbVsuBjneWH0pejawdRa7qj6SFm8dSaTLcMmN7taEPRUYCuvLb7BK6G9fXQ6vdK25J2XPru11yRwAN4C6khwPddUWWM5rZIwXrDSkBbfXN8Fyw0269OvKbspQKbBtOBZD4KcCaanQpjJ1u/K72SWFKG6qONN8roXWgLimofhUlgshRYipkP3gJFaHSY+lu4VqomC0CIEBS1K3CA6ztslPOyS4+pEn2qCv1ChjSWsf57sWGR0h/C1mpE/TH55WS1poOKNueV2gew2hmDEHfedyfcpJqXJrkMSGOPQ3dJ0/wBT5C7cl1LapX08VOPSs9h6Y2XxLlytPpjHS34K0/Y/hQNB3ycx5+5025RovIyXYbCJrDQOfhR9JyRLhdfu4lS/E7QdKmNb0AqnSPRgRtbsKH+UE3NYJMzCjO4a8kj+ynS48ZFigVXWTqsd9hsrQ+p26DN+IDLFhtg3PnvDBSunyMixY4xsAKATOqtB1vSGEAt8wmj7hSdcjYyKMtFFXQ9AC+AvKzOkNdLqOdk+76H4V/iPd9Ad/dVeggHDyHEeoyGyoLFslCjuqTxPDHLgMjbQkkeB/ZXZaD2WZ1x7jq2Ay/Td18q4LWPElgxowKIDaTT39J6XAhXDP5QCjzxMLLLRaYmsblytn8VQR3bYx1be6vTOKtZlzQ3xRORsQKCueo+6YiUZL37rNumGR4qBJtsbP8q6DiS4E8LP4R6vEWVfYKNNLbUpuwUUbttda53TygroP4jxeXHcMjparpBbRGyyekE/9czHdwaC1bCSgbfhse2+kKj0fCkdrGbOwghp6QVpXkiEkc9JKh+Fmh0GQ8gFxmIJQS4pjXS9vSfdQZZhkeIYI79OOOo/BV3JGx7SXN3WV0ok+IdRJ3qTpH4Vwa9rg4Kk8TSh2JDjDmR9H5CsGk+6o9ac52pYDSbHWoNdiRBuFG2tgNgm5mMjaX9O47qZAP4ZoUHUCRE0djygr3PM0hY1pN91L0mNsD5m97T2DGxsQcGi0zF6M2cN2FWglajmNx4DX3dlmThyOyDltFk8hS857pM8MebbXCkYAFS/B2QMjKc2P1NIQ3NjH3AqY8B4ogV+FBkY0XsEVS6nqP1mY3GaSBdkK2w55o4WRtNNas1Kxo8QtAGxWwxWjyxsN0ErGkkd9znV+VzVY/O0yUVuAnmtAFAJWaB9DN+FbUN+GZK09je4V95gLVk/DZPlPF7ArSDbhNDpHWCDuCjQv4bU5IXGg7hdadk1FtqmO4ck7lZ7mzFn1r1DnmecgRNb6a3UwchNtY0yudW/uvHHakRxO5uh7J9C5ZRMx//Z");

dump(UserService::changePhoto($apiContext, $photo));