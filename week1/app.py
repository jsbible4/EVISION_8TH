from flask import Flask, request, render_template, redirect
import sqlite3

app = Flask(__name__)

def get_db_connection():
    conn = sqlite3.connect('guestbook.db')
    conn.row_factory = sqlite3.Row
    return conn

@app.route('/')
def home():
    return render_template('index.html')

@app.route('/search')
def search():
    query = request.args.get('q', '') 

    return f"검색 결과: {query}" 

@app.route('/write', methods=['GET', 'POST'])
def write():
    if request.method == 'POST':
        name = request.form['name']
        message = request.form['message']
        conn = get_db_connection()
        conn.execute('INSERT INTO guestbook (name, message) VALUES (?, ?)', (name, message))
        conn.commit()
        conn.close()
        return redirect('/write')
    conn = get_db_connection()
    entries = conn.execute('SELECT * FROM guestbook').fetchall()
    conn.close()
    return render_template('index.html', entries=entries)

if __name__ == '__main__':
    app.run(debug=True)

