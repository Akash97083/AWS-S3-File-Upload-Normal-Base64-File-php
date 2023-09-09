# AWS-S3-File-Upload-Normal-Base64-File
## AWS CONFIG
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=
AWS_BUCKET=
AWS_BUCKET_IMAGES=
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
PUBLIC ACCESS PERMISSON FOR AWS BUCKET FOLDER
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Sid": "PublicRead",
            "Effect": "Allow",
            "Principal": "*",
            "Action": [
                "s3:GetObject",
                "s3:GetObjectVersion"
            ],
            "Resource": "arn:aws:s3:::demo-upload-all-files/*"
        }
    ]
}
