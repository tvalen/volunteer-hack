'''
Created on Sep 4, 2014

@author: jacoba
'''
import MySQLdb
import urlparse
import os
import logging

if __name__ == '__main__':
    
    try:
        logging.basicConfig()
        log = logging.getLogger('paas-sample')
        log.setLevel(logging.DEBUG)

        mysql_url = urlparse.urlparse(os.environ['MYSQL_URL'])
    
        #rdb = redis.Redis(host=url.hostname, port=url.port, password=url.password)
        
        url = mysql_url.hostname
        password = mysql_url.password
        userName = mysql_url.username
        dbName = mysql_url.path[1:] # slice off the '/'
        db = MySQLdb.connect(host=url,user=userName,passwd=password,db=dbName)
        
        table_create = 'CREATE TABLE IF NOT EXISTS tempusers( user_id int not null auto_increment, user_fname varchar(100) NOT NULL, user_lname varchar(100) NOT NULL, user_email varchar(100),PRIMARY KEY(user_id), UNIQUE(user_fname,user_lname,user_email));'
        
        cur = db.cursor()

        log.debug('executing table create')
        
        cur.execute(table_create)
        db.commit()
        try:
            user1_insert = "INSERT INTO tempusers(user_fname, user_lname, user_email) values('john','doe','john.doe@foo.com')"
            user2_insert = "INSERT INTO tempusers(user_fname, user_lname, user_email) values('jane','doe','jane.doe@foo.com')"
            log.debug('inserting user 1')
            cur.execute(user1_insert)
            log.debug('inserting user 2')
            cur.execute(user2_insert)
            db.commit()
        except:
            print "users already exist"

    except MySQLdb.Error, e:
        print "Exception during database initialization: %s"%str(e)
