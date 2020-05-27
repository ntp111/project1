import cv2
import dns
import pymongo

client = pymongo.MongoClient("mongodb+srv://admin:admin@cluster0-xkizr.mongodb.net/test?retryWrites=true&w=majority")
db = client['aids']

vidcap = cv2.VideoCapture('https://drive.google.com/file/d/1MLEXQy3m_MD4-bzZdKwa2F8sdEBN1q5a')
success,image = vidcap.read()
fps = vidcap.get(cv2.CAP_PROP_FPS)
fps2 = int(fps)
if fps2 < 30:
  fps2 = 30
elif fps2 > 30 and fps2 < 60:
  fps2 = 60
print('Video FPS rate is {}'.format(fps2))
frame_count = int(vidcap.get(cv2.CAP_PROP_FRAME_COUNT))
duration = frame_count/fps2
print('number of frames = ' + str(frame_count))
print('duration (S) = ' + str(duration))
minutes = int(duration/60)
seconds = duration%60
print('duration (M:S) = ' + str(minutes) + ':' + str(seconds))
vidcap.release()
print ('Extraction completed!')