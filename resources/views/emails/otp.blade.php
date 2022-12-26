<!DOCTYPE html>
<html lang="en">

<head>
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
</head>

<body>
    <table cellspacing="0" cellpadding="0"  bgcolor="#f2f2f2" width="600"
        style="width:600px; margin:0 auto; font-family: Arial, Helvetica, sans-serif; ">
       
       
        <tr>
            <td>
                <table border="0" width="100%" style="padding:30px 20px 50px;">
                   
                    <tr>
                        <th align="left"
                            style="font-size:17px; color:#676777; font-family: Arial, Helvetica, sans-serif; line-height: 20px; border:none;">
                            Hi {{ $name }},</th>
                    </tr>
                    <tr>
                        <td height="5px"></td>
                    </tr>
                    <tr>
                        <td align="left"
                            style="font-size:15px; color:#676777; font-family: Arial, Helvetica, sans-serif; line-height: 20px;">
                            Your E-mail OTP for login in ACMA is {{ $otp }}<br/></td>

                    </tr>
                    
                    
                    <tr>
                        <td height="30"></td>
                    </tr>
                    <tr>
                        <th align="left"
                            style="font-size:15px; color:#676777; font-family: Arial, Helvetica, sans-serif; line-height: 20px;">
                            Team ACMA<br/>
                        
                        </th>
                    </tr>
                </table>
            </td>
        </tr>
        
    </table>
</body>

</html>
