# if you have task go
task rebuild
task up
task tests
# else
docker-compose up -d --build
 check  api
http://127.0.0.1:8000/api/docs
