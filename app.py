from flask import Flask, render_template, request, redirect, url_for

app = Flask(__name__)

from templates import suggest_mutual_friends

# Example graph representing friend requests
graph = {
    "Selcia": {
        "Sasmitha": {"time": 4, "strength": 10},
        "Jebicia": {"time": 10, "strength": 8},
        "John": {"time": 7, "strength": 9},
        "Emma": {"time": 6, "strength": 11},
        "Michael": {"time": 9, "strength": 7},
        "Jebi": {"time": 4, "strength": 11}
    },
    "Jebi": {
        "Selcia": {"time": 4, "strength": 11},
        "Shashwat": {"time": 5, "strength": 8},
        "Sherwin": {"time": 3, "strength": 9},
        "John": {"time": 6, "strength": 10},
        "Sasmitha": {"time": 4, "strength": 11},
        "Emma": {"time": 5, "strength": 8},
        "Michael": {"time": 8, "strength": 7}
    },
    "Sasmitha": {
        "Selcia": {"time": 4, "strength": 11},
        "Shashwat": {"time": 5, "strength": 8},
        "Sherwin": {"time": 3, "strength": 9},
        "John": {"time": 6, "strength": 10},
        "Jebi": {"time": 4, "strength": 11}
    },
    "Jebicia": {
        "Selcia": {"time": 3, "strength": 11},
        "John": {"time": 8, "strength": 7},
        "Jebi": {"time": 4, "strength": 11}
    },
    "Shashwat": {
        "Selcia": {"time": 8, "strength": 10},
        "Emma": {"time": 7, "strength": 9},
        "John": {"time": 8, "strength": 7},
        "Jebi": {"time": 5, "strength": 8}
    },
    "Sherwin": {
        "Selcia": {"time": 17, "strength": 7},
        "Emma": {"time": 5, "strength": 8},
        "John": {"time": 8, "strength": 7},
        "Jebi": {"time": 3, "strength": 9}
    },
    "John": {
        "Selcia": {"time": 7, "strength": 10},
        "Emma": {"time": 12, "strength": 8},
        "Michael": {"time": 9, "strength": 9},
        "Jebi": {"time": 6, "strength": 10}
    },
    "Emma": {
        "Selcia": {"time": 6, "strength": 11},
        "Sasmitha": {"time": 7, "strength": 9},
        "Sherwin": {"time": 10, "strength": 8},
        "John": {"time": 8, "strength": 7},
        "Michael": {"time": 6, "strength": 11}
    },
    "Michael": {
        "Selcia": {"time": 9, "strength": 7},
        "Jebi": {"time": 8, "strength": 9},
        "Emma": {"time": 6, "strength": 11}
    }
}

def suggest_mutual_friends(user, graph):
    # Get all the neighbors of the user
    user_neighbors = graph[user]
    
    # Collect all neighbors of the user's neighbors
    potential_friends = set()
    for neighbor in user_neighbors:
        for potential_friend in graph[neighbor]:
            if potential_friend != user and potential_friend not in user_neighbors:
                potential_friends.add(potential_friend)
    
    # Count the mutual friends for each potential friend
    mutual_friends_count = {}
    for potential_friend in potential_friends:
        mutual_friends = set(graph[potential_friend]) & set(user_neighbors)
        mutual_friends_count[potential_friend] = len(mutual_friends)
    
    # Sort the potential friends by number of mutual friends
    sorted_potential_friends = sorted(mutual_friends_count, key=mutual_friends_count.get, reverse=True)
    
    # Return the potential friends with the most mutual friends
    mutual_friends = set()
    for potential_friend in sorted_potential_friends:
        if mutual_friends_count[potential_friend] > 1:
            mutual_friends.add(potential_friend)
    
    return mutual_friends

def merge_sort_friend_requests(graph, user_id, sort_criteria):
    if len(graph) <= 1:
        return list(graph.items())

    # Divide the graph into two halves
    mid = len(graph) // 2
    left_half = dict(list(graph.items())[:mid])
    right_half = dict(list(graph.items())[mid:])

    # Recursively sort the left and right halves
    sorted_left = merge_sort_friend_requests(left_half, user_id, sort_criteria)
    sorted_right = merge_sort_friend_requests(right_half, user_id, sort_criteria)

    # Merge the sorted halves
    return merge(sorted_left, sorted_right, user_id, sort_criteria)


def merge(left, right, user_id, sort_criteria):
    merged = []
    left_index = 0
    right_index = 0

    while left_index < len(left) and right_index < len(right):
        left_node, left_value = left[left_index]
        right_node, right_value = right[right_index]

        # Compare values using the 'time' key with a default value of 0
        left_time = left_value.get('time', 0)
        right_time = right_value.get('time', 0)

        if left_time < right_time:
            merged.append((left_node, left_value))
            left_index += 1
        else:
            merged.append((right_node, right_value))
            right_index += 1

    # Append the remaining elements from the left or right list
    merged.extend(left[left_index:])
    merged.extend(right[right_index:])

    return merged

def sort_friend_requests(graph, user_id, sort_criteria):
    criteria_index = {'name': 0, 'age': 1, 'location': 2, 'time': 3}  # Add 'time' key
    incoming_edges = [(node, edges[user_id]['time']) for node, edges in graph.items() if user_id in edges]
    sorted_requests = sorted(incoming_edges, key=lambda node: criteria_index.get(sort_criteria, 0) if isinstance(node[1], dict) else 0, reverse=True)
    return sorted_requests

# Route to render the HTML page
@app.route('/')
def index():
    return render_template('index.html')

@app.route('/main_page')
def main_page():
    user_id = "Jebi"  # Set the user ID (can be changed as needed)
    # Get the trending posts (implement this function according to your requirements)

    accepted_users = []
    mutual_friends = {}

    for request_id in accepted_requests:
        accepted_users.append(request_id)  # You can modify this to retrieve user details from a database based on the request_id

        # Suggest mutual friends for each accepted request
        mutual_friends[request_id] = suggest_mutual_friends(request_id, graph)

    return render_template('index1.php', accepted_users=accepted_users, mutual_friends=mutual_friends)


@app.route('/login_page')
def login_page():
    return render_template('login.html')

@app.route('/friend_request')
def friend_request():
    sort_criteria = request.args.get('sort_criteria', 'time')  # Get the sorting criteria from the query parameter (default: time)
    user_id = "Jebi"  # Set the user ID (can be changed as needed)
    sorted_requests = sort_friend_requests(graph, user_id, sort_criteria)
    return render_template('friend_request.html', sorted_requests=sorted_requests, sort_criteria=sort_criteria)


accepted_requests = []
# Route to accept a friend request
@app.route('/accept_request/<request_id>')
def accept_request(request_id):
    user_id = "Jebi"  # Set the user ID (can be changed as needed)
    if user_id in graph[request_id]:
        accepted_requests.append(request_id)
        del graph[request_id][user_id]
    return redirect(url_for('friend_request'))#"Friend request accepted successfully."

# Route to reject a friend request
@app.route('/reject_request/<request_id>')
def reject_request(request_id):
    user_id = "Jebi"  # Set the user ID (can be changed as needed)
    if user_id in graph[request_id]:
        del graph[request_id][user_id]
    return redirect(url_for('friend_request'))#"Friend request rejected successfully."

@app.route('/accepted_requests')
def get_accepted_requests():
    accepted_users = []
    for request_id in accepted_requests:
        accepted_users.append(request_id)  # You can modify this to retrieve user details from a database based on the request_id
    return render_template('get_accepted_requests.html', accepted_users=accepted_users)

if __name__ == '__main__':
    app.run(debug = True)

'''
# Sort friend requests for user "Sasmitha" based on time
sort_criteria = "time"
user_id = "Selcia"
sorted_requests = sort_friend_requests(graph, user_id, sort_criteria)
print(sorted_requests) # [("Sherwin", "Jebicia"), ("Shashwat", "Shasvat")]

# Sort friend requests for user "Jebicia" based on strength
sort_criteria = "strength"
user_id = "Jebicia"
sorted_requests = sort_friend_requests(graph, user_id, sort_criteria)
print(sorted_requests) # [("Selcia", 8), ("Shrikar", "Shasvat")]'''