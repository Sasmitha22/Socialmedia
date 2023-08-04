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

#sample input:
'''
graph = {
    'Alice': {'Bob', 'Charlie', 'David'},
    'Bob': {'Alice', 'Eve'},
    'Charlie': {'Alice', 'Dave'},
    'David': {'Alice', 'Eve'},
    'Dave': {'Charlie', 'Eve'},
    'Eve': {'Bob', 'David', 'Dave'}
}

user = 'Alice'
print(suggest_mutual_friends(user, graph))

'''
# expected output:
#{'Eve'}
