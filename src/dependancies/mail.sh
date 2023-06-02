#  curl  \
#  --ssl-reqd \
#  --url 'smtps://smtp.gmail.com:465' \
#  --user 'denanu.pandovah@gmail.com:xqsbveoiodtkelyj' \
#  --mail-from denanu.pandovah@gmail.com \
#  --mail-rcpt julian.wandhoven@gmail.com \
#  --upload-file mail.txt


title=$1;
content=$3;
username=$2;

user="denanu.pandovah@gmail.com";
rcpt='julian.wandhoven@gmail.com';


email_content='From: '"${title}"' <'"${user}"'>
To: "Gmail" <'"${rcpt}"'>
Subject: from '"${user}"' to Gmail
Date: '"$(date)"'

Dear '"${username}"'

'"${content}"'

Regards,
Denanu-Login
';


echo "$email_content" | curl -s \
    --ssl-reqd \
    --url "smtps://smtp.gmail.com:465" \
    --user "${user}:xqsbveoiodtkelyj" \
    --mail-from "${user}" \
    --mail-rcpt "${rcpt}" \
    --upload-file - # email.txt